<?php
require_once(__DIR__.'/header.php');
require_once(__DIR__ . '/bdd.php');

// Connexion à la base de données via la fonction
$mysqlClient = connexion();

if ($mysqlClient) {
    // Requête SQL pour récupérer toutes les oeuvres
    $sqlQuery = 'SELECT * FROM oeuvres';
    $oeuvresStatement = $mysqlClient->prepare($sqlQuery); // Préparation de la requête
    $oeuvresStatement->execute(); // Exécution de la requête
    $oeuvres = $oeuvresStatement->fetchAll(); // Récupération de tous les résultats
} else {
    // En cas d'échec de connexion, afficher un message
    echo "Erreur de connexion à la base de données.";
}
?>
<div id="liste-oeuvres">
    <?php if (!empty($oeuvres)): ?>
        <?php foreach($oeuvres as $oeuvre): ?>
            <article class="oeuvre">
                <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                    <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                    <h2><?= $oeuvre['titre'] ?></h2>
                    <p class="description"><?= $oeuvre['artiste'] ?></p>
                </a>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune oeuvre disponible.</p>
    <?php endif; ?>
</div>
<?php require 'footer.php'; ?>
