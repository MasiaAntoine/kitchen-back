import { execSync } from "child_process";
import path from "path";
import fs from "fs";
import dotenv from "dotenv";

dotenv.config();

// Charger les variables d'environnement depuis le fichier .env
const SSH_KEY = process.env.SSH_DEPLOY_KEY;
const REMOTE_USER = process.env.REMOTE_USER;
const REMOTE_HOST = process.env.REMOTE_HOST;
const REMOTE_PORT = process.env.REMOTE_PORT;
const REMOTE_PATH = process.env.REMOTE_PATH;

// Nom du dossier à déployer
const VENDOR_DIR = "kitchen/vendor";

// Fonction pour exécuter une commande shell et afficher un message
function run(command, message) {
    console.log(`\x1b[36m› ${message}...\x1b[0m`);
    execSync(command, { stdio: "inherit" });
}

try {
    // Vérifier si le dossier "vendor" existe
    if (!fs.existsSync(VENDOR_DIR)) {
        throw new Error(`Le dossier '${VENDOR_DIR}' n'existe pas.`);
    }

    // Commande SCP pour transférer le dossier "vendor" vers le serveur distant
    const scpCommand = `scp -i ${SSH_KEY} -P ${REMOTE_PORT} -r ${VENDOR_DIR} ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}`;
    run(scpCommand, `Uploading '${VENDOR_DIR}' folder to server`);

    console.log("\x1b[32m✔ Vendor folder deployed successfully!\x1b[0m");
} catch (err) {
    // Gérer les erreurs de déploiement
    console.error("\x1b[31m✖ Deployment failed:\x1b[0m", err.message);
    process.exit(1);
}
