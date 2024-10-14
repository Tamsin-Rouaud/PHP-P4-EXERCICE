<?php
require_once(__DIR__.'/header.php');
require_once(__DIR__ . '/bdd.php');

// Connexion à la base de données via la fonction
$mysqlClient = getConnected();

if ($mysqlClient) {
    // Requête SQL pour récupérer toutes les oeuvres
    $sqlQuery = 'SELECT * FROM oeuvres';
    $artworksStatement = $mysqlClient->prepare($sqlQuery); // Préparation de la requête
    $artworksStatement->execute(); // Exécution de la requête
    $artworks = $artworksStatement->fetchAll(); // Récupération de tous les résultats
} else {
    // En cas d'échec de connexion, afficher un message
    echo "Erreur de connexion à la base de données.";
}
?>
<div id="liste-oeuvres">
    <?php if (!empty($artworks)): ?>
        <?php foreach($artworks as $artwork): ?>
            <article class="oeuvre">
                <a href="oeuvre.php?id=<?= $artwork['id'] ?>"> 
                    <img src="<?= $artwork['picture'] ?>" alt="<?= $artwork['title'] ?>"> 
                    <h2><?= $artwork['title'] ?></h2> 
                    <p class="description"><?= $artwork['artist'] ?></p> 
                </a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune oeuvre disponible.</p>
    <?php endif; ?>
</div>
<?php require_once(__DIR__.'/footer.php'); ?>
