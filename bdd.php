<?php
    // Inclusion du fichier de configuration où sont stockées les constantes pour la base de données
    require_once(__DIR__ . '/config/mysql.php');

    // Définition de la fonction 'connexion' pour se connecter à la base de données
    function connexion(){
        // Tentative de création d'un nouvel objet PDO pour se connecter à la base de données
        try {
            
            
            $pdo = new PDO(
                /* sprintf est utilisé pour insérer les constantes MYSQL_HOST et MYSQL_BASENAME dans la chaîne de connexion.
                La chaîne de connexion PDO pour MySQL inclut l'hôte (MYSQL_HOST), le nom de la base de données (MYSQL_BASENAME),
                et définit le charset comme UTF-8 pour éviter les problèmes d'encodage */
                sprintf('mysql:host=%s;dbname=%s;charset=utf8', MYSQL_HOST, MYSQL_BASENAME),
                
                // Identifiant de l'utilisateur de la base de données
                MYSQL_ID,

                // Mot de passe de l'utilisateur
                MYSQL_PASSWORD,

                // Options pour la connexion PDO
                [
                    /* On définit le mode de gestion des erreurs à PDO::ERRMODE_EXCEPTION pour lever des exceptions en cas d'erreur
                    Cela permet d'avoir des messages d'erreur plus explicites, utiles pour déboguer*/
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
            
            // La connexion est réussie, on retourne l'objet PDO pour l'utiliser dans les futures requêtes SQL
            return $pdo; 
        } catch (Exception $e) {
            // Si une exception (erreur) survient lors de la connexion, on arrête le script et affiche un message d'erreur
            die('Erreur : ' . $e->getMessage());
        }
    }
?>
