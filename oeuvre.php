<?php
require_once(__DIR__ . '/bdd.php');
$mysqlClient = getConnected(); //   getConnected() 

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if (empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

// Connexion à la base de données via la fonction
$sqlQuery = 'SELECT * FROM oeuvres WHERE id = :id';
$artworksStatement = $mysqlClient->prepare($sqlQuery); // Préparation de la requête
$artworksStatement->execute(['id' => intval($_GET['id'])]); // Exécution de la requête
$artwork = $artworksStatement->fetch(); // Récupération de l'œuvre

// Si aucune oeuvre trouvée, on redirige vers la page d'accueil
if (!$artwork) {
    header('Location: index.php');
    exit;
}

require 'header.php';
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $artwork['picture'] ?>" alt="<?= htmlspecialchars($artwork['title']) ?>"> 
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($artwork['title']) ?></h1> 
        <p class="description"><?= htmlspecialchars($artwork['artist']) ?></p> 
        <p class="description-complete">
            <?= htmlspecialchars($artwork['description']) ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
