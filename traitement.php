<!-- 
** Pour une oeuvre, garantir que le titre est saisi, l'artiste est saisi, que la description fasse au moins 3 caractères et le lien vers l'image doit bien avoir le format attendu, à savoir https:... . On doit contrôler que la variable contient bien un lien et qu'il retourne bien une image dans traitement.php'

** Si les champs ne sont pas valides, on retrounera un message d'erreur (et/ou) avec le formulaire à recompléter? si les champs sont valides, on indsère l'oeuvre en bdd (dans la prochaine étape) 

** htmlspecialchars sur les données en affichées avec echo en provenance du formulaire on peu aussi utiliser strip_tags pour retirer les balises html au lieu de les échapper et les afficher. cela permet de se prémunir contre les failles xss

** en HTML, on demande à ce que les &  soient écrits &amp;  dans le code source. Si vous ne le faites pas, le code ne passera pas la validation W3C.

**  
-->

<?php
    // require_once(__DIR__.'/header.php');

    
    

// Vérification des champs du formulaire
if (empty($_POST['title']) // Vérifie si le champ 'title' est vide
    || empty($_POST['artist'])  // Vérifie si le champ 'artiste' est vide
    || empty($_POST['description'])  // Vérifie si le champ 'description' est vide
    || empty($_POST['picture'])  // Vérifie si le champ 'image' est vide
    || strlen($_POST['description']) < 3  // Vérifie que la description contient au moins 3 caractères
    || !filter_var($_POST['picture'], FILTER_VALIDATE_URL) // Vérifie que l'URL de l'image est valide
    || !preg_match('/\.(jpg|jpeg|png|gif)$/i', $_POST['picture']) // Vérifie que l'URL de l'image finit par une extension d'image valide
) {
    // Si une des conditions échoue, redirige l'utilisateur vers ajouter.php avec le paramètre 'erreur=true'
    header('Location: ajouter.php?erreur=true');
} else {
    // Si toutes les conditions sont respectées, on sécurise les données
    $title = htmlspecialchars($_POST['title']); // Sécurise le titre pour éviter les injections XSS
    $description = htmlspecialchars($_POST['description']); // Sécurise la description pour éviter les injections XSS
    $artist = htmlspecialchars($_POST['artist']); // Sécurise le nom de l'artiste
    $picture = htmlspecialchars($_POST['picture']);  // Sécurise l'URL de l'image

    // Puis on insère notre oeuvre en base de données / Est-ce qu'on redirige l'user vers la page d'accueil?
    require_once(__DIR__ . '/bdd.php'); 
    $bdd = getConnected();
    // Préparation de la requête d'insertion en bdd
    // Préparation de la requête d'insertion en base de données avec des variables nommées
$req = $bdd->prepare('INSERT INTO oeuvres (title, description, artist, picture) 
                     VALUES (:title, :description, :artist, :picture)');

// Exécution de la requête avec les données sécurisées
$req->execute([
    ':title' => $title,
    ':description' => $description,
    ':artist' => $artist,
    ':picture' => $picture
]);


    // ... (code pour insérer l'oeuvre en base de données ici)

    // Redirection de l'utilisateur vers la page d'accueil avec son oeuvre et insérer message confirmation

    header('Location: index.php');
}

require_once(__DIR__.'/footer.php'); ?>
