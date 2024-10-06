<?php
require_once(__DIR__ . '/config/mysql.php');

// Appel de la fonction connexion pour contenir l'objet PDO
function connexion(){
    try {
        $pdo = new PDO(
            sprintf('mysql:host=%s;dbname=%s;charset=utf8', MYSQL_HOST, MYSQL_BASENAME),
            MYSQL_ID,
            MYSQL_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        // Ne pas oublier de retourner l'objet PDO
        return $pdo; 
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

?>
