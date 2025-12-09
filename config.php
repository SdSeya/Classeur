<?php
/**
 * config.php
 *
 * Configuration centralisée pour la connexion à la base de données.
 * Retourne un tableau de configuration. Tu peux remplacer les valeurs
 * par des variables d'environnement (recommandé en production).
 *
 * Usage :
 *   // Copie ce fichier sous le nom config.php ou laisse tel quel et le script
 *   // cherchera config.php puis config.php automatiquement.
 */

return [
    // Hôte MariaDB (127.0.0.1 ou adresse du serveur)
    'db_host' => getenv('DB_HOST') ?: '127.0.0.1',

    // Nom de la base (tu as précisé "Classeur")
    'db_name' => getenv('DB_NAME') ?: 'Classeur',

    // Utilisateur / mot de passe DB
    'db_user' => getenv('DB_USER') ?: 'Classeur',
    'db_pass' => getenv('DB_PASS') ?: 'Ninja7team22',

    // Options PDO par défaut (tu peux les modifier ici)
    'pdo_options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

// config.php
$host = "localhost";
$dbname = "classeur";   // nom de ta base
$username = "root";     // ton utilisateur MySQL
$password = "";         // ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
