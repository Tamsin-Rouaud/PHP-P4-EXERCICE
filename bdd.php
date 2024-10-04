<?php

# Ce fichier sert à faciliter la connexion à la base de données via PDO en utilisant les variables définies dans mysql.php
# 'require_once' inclut le fichier mysql.php pour récupérer les informations nécessaires à la connexion (hôte, nom de la base de données, identifiant, mot de passe)
require_once(__DIR__ . '/config/mysql.php');

try {
    // On essaie d'établir une connexion à la base de données MySQL en utilisant PDO (PHP Data Objects)
    // PDO est une interface permettant de se connecter à différentes bases de données de manière sécurisée et simplifiée

    $mysqlClient = new PDO(
        // sprintf permet de formater une chaîne de caractères. Ici, on construit l'URL de connexion à la base de données
        // 'mysql:host=%s;dbname=%s;charset=utf8' est le format de l'URL de connexion où :
        // - %s représente l'hôte et le nom de la base de données (provenant des constantes MYSQL_HOST et MYSQL_BASENAME)
        // - 'charset=utf8' assure que les échanges de données avec MySQL se fassent avec le bon encodage de caractères (UTF-8)
        sprintf('mysql:host=%s;dbname=%s;charset=utf8', MYSQL_HOST, MYSQL_BASENAME),
        
        // MYSQL_ID et MYSQL_PASSWORD contiennent les informations d'identification pour se connecter à la base de données (définies dans mysql.php)
        MYSQL_ID,
        MYSQL_PASSWORD,
        
        // Ce tableau d'options PDO spécifie que si une erreur survient, PDO doit lever une exception (grâce à PDO::ERRMODE_EXCEPTION)
        // Cela permet de gérer proprement les erreurs et d'afficher des messages explicatifs en cas de problème
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

} catch (Exception $e) {
    // Si une erreur survient pendant la tentative de connexion, le script entre dans le bloc "catch"
    // Ici, on utilise la fonction die() pour afficher un message d'erreur et stopper l'exécution du script
    // Le message contient l'erreur exacte grâce à $e->getMessage(), ce qui est utile pour déboguer
    die('Erreur : ' . $e->getMessage());
}

// Si la connexion réussit (aucune exception levée), le script continue à s'exécuter normalement
?>
