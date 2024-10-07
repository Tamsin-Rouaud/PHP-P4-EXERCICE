<?php
    require_once(__DIR__ . '/bdd.php');
    $mysqlClient = connexion(); //   getConnexion() 

 // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
        exit;
    }

    // Connexion à la base de données via la fonction
    $sqlQuery = 'SELECT * FROM oeuvres WHERE id = :id';
    $oeuvresStatement = $mysqlClient->prepare($sqlQuery); // Préparation de la requête
    $oeuvresStatement->execute(['id' => intval($_GET['id'])]); // Exécution de la requête
    $oeuvre = $oeuvresStatement->fetch(); // Récupération de tous les résultats
      
    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    
    if(!$oeuvre) {
        header('Location: index.php');
        exit;
    }

    require 'header.php';
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
