import { execSync } from "child_process";
import path from "path";
import fs from "fs";
import dotenv from "dotenv";

dotenv.config();

const SSH_KEY = process.env.SSH_DEPLOY_KEY;
const REMOTE_USER = process.env.REMOTE_USER;
const REMOTE_HOST = process.env.REMOTE_HOST;
const REMOTE_PORT = process.env.REMOTE_PORT;
const REMOTE_PATH = process.env.REMOTE_PATH;

const DEPLOY_DIR = "kitchen";
const TEMP_DIR = "deploy_temp";
const REQUIRED_FILES = [
    "app",
    "bootstrap",
    "config",
    "database",
    "public",
    "resources",
    "routes",
    "artisan",
    "composer.json",
    "composer.lock",
    "storage",
    ".env",
];

// Fichiers et dossiers à exclure
const EXCLUDE_PATTERNS = [
    ".gitignore",
    "resources/js/front",
    "resources/js/components",
    "public/js/front",
    "public/css/front",
];

function run(command, message) {
    console.log(`\x1b[36m› ${message}...\x1b[0m`);
    execSync(command, { stdio: "inherit" });
}

function shouldExclude(filePath) {
    return EXCLUDE_PATTERNS.some((pattern) => filePath.includes(pattern));
}

try {
    // Préparation du dossier temporaire
    if (fs.existsSync(TEMP_DIR)) {
        fs.rmSync(TEMP_DIR, { recursive: true });
    }
    fs.mkdirSync(TEMP_DIR, { recursive: true });

    // Copier les fichiers nécessaires
    for (const file of REQUIRED_FILES) {
        const src = path.resolve(file);
        const dest = path.join(TEMP_DIR, file);

        if (!fs.existsSync(src)) {
            console.log(
                `\x1b[33m⚠ Attention: ${file} n'existe pas, on l'ignore\x1b[0m`
            );
            continue;
        }

        if (fs.lstatSync(src).isDirectory()) {
            fs.mkdirSync(dest, { recursive: true });

            // Copie récursive des fichiers en excluant les patterns indiqués
            const copyRecursive = (sourcePath, destPath) => {
                const files = fs.readdirSync(sourcePath);

                for (const file of files) {
                    const srcFile = path.join(sourcePath, file);
                    const destFile = path.join(destPath, file);

                    if (shouldExclude(srcFile)) {
                        console.log(`\x1b[33m⚠ Exclusion: ${srcFile}\x1b[0m`);
                        continue;
                    }

                    if (fs.lstatSync(srcFile).isDirectory()) {
                        fs.mkdirSync(destFile, { recursive: true });
                        copyRecursive(srcFile, destFile);
                    } else if (!file.endsWith(".gitignore")) {
                        fs.copyFileSync(srcFile, destFile);
                    }
                }
            };

            copyRecursive(src, dest);
            console.log(`\x1b[36m› Copying ${file}\x1b[0m`);
        } else if (!file.endsWith(".gitignore")) {
            fs.copyFileSync(src, dest);
            console.log(`\x1b[36m› Copying ${file}\x1b[0m`);
        }
    }

    // Renommer le dossier temporaire en "kitchen"
    if (fs.existsSync(DEPLOY_DIR)) {
        fs.rmSync(DEPLOY_DIR, { recursive: true });
    }
    fs.renameSync(TEMP_DIR, DEPLOY_DIR);

    // Supprimer uniquement les fichiers requis sur le serveur avant l'envoi
    console.log(
        `\x1b[36m› Suppression des fichiers requis sur le serveur...\x1b[0m`
    );
    for (const file of REQUIRED_FILES) {
        const remoteFile = file;
        const deleteCommand = `ssh -i ${SSH_KEY} -p ${REMOTE_PORT} ${REMOTE_USER}@${REMOTE_HOST} "if [ -e ${REMOTE_PATH}/${DEPLOY_DIR}/${remoteFile} ]; then rm -rf ${REMOTE_PATH}/${DEPLOY_DIR}/${remoteFile}; fi"`;
        run(deleteCommand, `Suppression de ${remoteFile} sur le serveur`);
    }

    // Envoi du dossier via SCP
    const scpCommand = `scp -i ${SSH_KEY} -P ${REMOTE_PORT} -r ${DEPLOY_DIR} ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}`;
    run(scpCommand, `Uploading '${DEPLOY_DIR}' folder to server`);

    // Ajouter les permissions sur le dossier et le fichier .env
    const chmodCommand = `ssh -i ${SSH_KEY} -p ${REMOTE_PORT} ${REMOTE_USER}@${REMOTE_HOST} "chmod -R 775 ${REMOTE_PATH}/${DEPLOY_DIR} && chmod 600 ${REMOTE_PATH}/${DEPLOY_DIR}/.env"`;
    run(chmodCommand, `Setting permissions on ${DEPLOY_DIR} and .env`);

    // Nettoyer les caches Laravel après le déploiement
    const clearCacheCommand = `ssh -i ${SSH_KEY} -p ${REMOTE_PORT} ${REMOTE_USER}@${REMOTE_HOST} "cd ${REMOTE_PATH}/${DEPLOY_DIR} && php artisan cache:clear && php artisan config:cache && php artisan view:clear && php artisan route:clear"`;
    run(clearCacheCommand, `Clearing Laravel caches on server`);

    // Nettoyage local
    fs.rmSync(DEPLOY_DIR, { recursive: true });
    console.log("\x1b[32m✔ Laravel API deployed successfully!\x1b[0m");
} catch (err) {
    console.error("\x1b[31m✖ Deployment failed:\x1b[0m", err.message);
    process.exit(1);
}
