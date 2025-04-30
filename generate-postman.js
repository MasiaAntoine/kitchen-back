import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import fetch from "node-fetch"; // Vous devrez installer ce package
import dotenv from "dotenv";

dotenv.config();

// Obtenir le chemin du répertoire actuel (équivalent à __dirname en CommonJS)
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Chemin vers le fichier de collection Postman généré par Scribe
const collectionPath = path.join(
    __dirname,
    "storage/app/private/scribe/collection.json"
);

// Configuration Postman - À définir dans vos variables d'environnement ou dans un fichier .env
const POSTMAN_API_KEY = process.env.POSTMAN_API_KEY;
const POSTMAN_COLLECTION_ID = process.env.POSTMAN_COLLECTION_ID; // ID de votre collection existante

console.log(
    "🔧 Modification de la collection Postman pour ajouter Basic Auth et améliorer les titres..."
);

try {
    // Lire le fichier JSON
    const collection = JSON.parse(fs.readFileSync(collectionPath, "utf8"));

    // S'assurer que les variables d'authentification existent
    if (!collection.variable) {
        collection.variable = [];
    }

    // Vérifier si les variables api_username et api_password existent déjà
    const hasUsername = collection.variable.some(
        (v) => v.key === "api_username"
    );
    const hasPassword = collection.variable.some(
        (v) => v.key === "api_password"
    );

    // Ajouter les variables si elles n'existent pas
    if (!hasUsername) {
        collection.variable.push({
            id: "api_username",
            key: "api_username",
            type: "string",
            value: "",
        });
    }

    if (!hasPassword) {
        collection.variable.push({
            id: "api_password",
            key: "api_password",
            type: "string",
            value: "",
        });
    }

    // Configurer l'authentification globale au niveau de la collection
    collection.auth = {
        type: "basic",
        basic: [
            {
                key: "username",
                value: "{{api_username}}",
                type: "string",
            },
            {
                key: "password",
                value: "{{api_password}}",
                type: "string",
            },
        ],
    };

    // Fonction pour supprimer les dossiers "tempo"
    function removeTempoFolders(items) {
        if (!items || !Array.isArray(items)) return items;

        // Filtrer pour supprimer les éléments nommés "tempo"
        const filteredItems = items.filter((item) => item.name !== "tempo");

        // Traiter récursivement les sous-dossiers
        for (const item of filteredItems) {
            if (item.item && Array.isArray(item.item)) {
                item.item = removeTempoFolders(item.item);
            }
        }

        return filteredItems;
    }

    // Fonction pour extraire les noms d'exemples des corps de réponse
    function extractResponseNames(items) {
        if (!items) return;

        for (const item of items) {
            if (item.response && Array.isArray(item.response)) {
                for (const response of item.response) {
                    // Cherche un format comme "success {...}" ou "error {...}"
                    const nameMatch = response.body.match(/^(\w+)\s+({.*})/s);
                    if (nameMatch && nameMatch.length > 2) {
                        // Extrait le nom et le corps JSON
                        const name = nameMatch[1];
                        const body = nameMatch[2];

                        // Met à jour la réponse avec le nom extrait et nettoie le corps
                        response.name = name;
                        response.body = body;
                    }
                }
            }

            // Traiter les sous-éléments récursivement
            if (item.item && Array.isArray(item.item)) {
                extractResponseNames(item.item);
            }
        }
    }

    // Fonction récursive pour appliquer l'authentification Basic à chaque requête et améliorer les titres
    // Fonction récursive pour appliquer l'authentification Basic à chaque requête et améliorer les titres
    function applyBasicAuthAndImproveNames(items) {
        if (!items) return;

        for (const item of items) {
            if (item.request) {
                // Vérifier si cette requête est la route de login (pour l'exclure de l'auth)
                const isLoginRoute =
                    item.request.url &&
                    item.request.url.path &&
                    item.request.url.path.includes("login") &&
                    item.request.method === "POST";

                // Appliquer l'authentification Basic explicitement à cette requête, sauf pour login
                if (!isLoginRoute) {
                    item.request.auth = {
                        type: "basic",
                        basic: [
                            {
                                key: "username",
                                value: "{{api_username}}",
                                type: "string",
                            },
                            {
                                key: "password",
                                value: "{{api_password}}",
                                type: "string",
                            },
                        ],
                    };
                } else {
                    // Pour la route de login, on s'assure qu'il n'y a pas d'authentification
                    console.log(
                        "🔓 Route /login détectée, pas d'authentification Basic appliquée"
                    );
                    item.request.auth = null;
                }
            }

            // Traiter les sous-dossiers récursivement
            if (item.item && Array.isArray(item.item)) {
                applyBasicAuthAndImproveNames(item.item);
            }
        }
    }

    // Supprimer les dossiers "tempo"
    if (collection.item && Array.isArray(collection.item)) {
        collection.item = removeTempoFolders(collection.item);
    }

    // Appliquer l'authentification et améliorer les titres
    if (collection.item && Array.isArray(collection.item)) {
        applyBasicAuthAndImproveNames(collection.item);
    }

    // Extraire les noms des exemples de réponse
    if (collection.item && Array.isArray(collection.item)) {
        extractResponseNames(collection.item);
    }

    // Sauvegarder les modifications dans le fichier d'origine
    fs.writeFileSync(collectionPath, JSON.stringify(collection, null, 2));

    // Définir le chemin du fichier de destination à la racine du projet
    const destPath = path.join(__dirname, "postman_generate.json");

    // Copier le fichier modifié vers la racine du projet
    fs.copyFileSync(collectionPath, destPath);

    console.log("✅ Collection Postman mise à jour avec succès !");
    console.log(`📍 Fichier original mis à jour : ${collectionPath}`);
    console.log(`📍 Collection copiée vers la racine : ${destPath}`);

    // Si l'API KEY Postman est définie, envoyer la collection à Postman
    if (POSTMAN_API_KEY && POSTMAN_COLLECTION_ID) {
        console.log("🚀 Envoi de la collection à Postman...");

        // Fonction pour envoyer la collection à Postman
        async function uploadToPostman() {
            try {
                console.log(
                    `🔍 Envoi vers ${
                        POSTMAN_COLLECTION_ID
                            ? "la collection existante"
                            : "une nouvelle collection"
                    }...`
                );

                let url = "https://api.getpostman.com/collections";
                let method = "POST";

                // Si un ID de collection est fourni, mettre à jour la collection existante
                if (POSTMAN_COLLECTION_ID) {
                    url = `https://api.getpostman.com/collections/${POSTMAN_COLLECTION_ID}`;
                    method = "PUT";
                }

                console.log(
                    `📤 Envoi vers l'URL: ${url} avec la méthode: ${method}`
                );

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        "X-API-Key": POSTMAN_API_KEY,
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        collection: collection,
                    }),
                });

                console.log(
                    `📊 Statut de la réponse: ${response.status} ${response.statusText}`
                );

                const data = await response.json();

                if (response.ok) {
                    console.log(
                        "✅ Collection " +
                            (method === "PUT" ? "mise à jour" : "créée") +
                            " avec succès dans Postman!"
                    );
                    console.log(
                        `📍 ID de la collection: ${data.collection.uid}`
                    );

                    // Si nous venons de créer une collection, afficher l'ID pour une utilisation future
                    if (method === "POST") {
                        console.log(
                            "⚠️ Veuillez mettre à jour votre variable POSTMAN_COLLECTION_ID avec cet ID pour les prochaines exécutions"
                        );
                    }

                    // Supprimer le fichier JSON généré après un envoi réussi
                    try {
                        fs.unlinkSync(destPath);
                        console.log(
                            `🧹 Fichier temporaire supprimé : ${destPath}`
                        );
                    } catch (deleteError) {
                        console.error(
                            `⚠️ Impossible de supprimer le fichier temporaire : ${deleteError.message}`
                        );
                    }
                } else {
                    console.error(
                        `❌ Erreur lors de ${
                            method === "PUT" ? "la mise à jour" : "la création"
                        } de la collection dans Postman:`,
                        data.error
                    );
                }
            } catch (error) {
                console.error(
                    "❌ Erreur lors de l'envoi à l'API Postman:",
                    error.message
                );
                console.error("❌ Erreur détaillée:", error);
            }
        }

        // Exécuter la fonction d'upload
        uploadToPostman().catch((err) => {
            console.error("❌ Erreur inattendue:", err);
        });
    }

    console.log(
        "✅ Les noms des exemples de réponse ont été extraits correctement."
    );
} catch (error) {
    console.error(
        "❌ Erreur lors de la modification de la collection :",
        error.message
    );
    process.exit(1);
}
