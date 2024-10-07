<!-- 
** Pour une oeuvre, garantir que le titre est saisi, l'artiste est saisi, que la description fasse au moins 3 caractères et le lien vers l'image doit bien avoir le format attendu, à savoir https:... . On doit contrôler que la variable contient bien un lien et qu'il retourne bien une image dans traitement.php'

** Si les champs ne sont pas valides, on retrounera un message d'erreur (et/ou) avec le formulaire à recompléter? si les champs sont valides, on indsère l'oeuvre en bdd (dans la prochaine étape) 

** htmlspecialchars sur les données en affichées avec echo en provenance du formulaire on peu aussi utiliser strip_tags pour retirer les balises html au lieu de les échapper et les afficher. cela permet de se prémunir contre les failles xss

** en HTML, on demande à ce que les &  soient écrits &amp;  dans le code source. Si vous ne le faites pas, le code ne passera pas la validation W3C.

**  
-->

<?php
    require_once(__DIR__.'/header.php');
    require_once(__DIR__ . '/bdd.php'); 
    
    

// Vérification des champs du formulaire
if (empty($_POST['titre']) // Vérifie si le champ 'titre' est vide
    || empty($_POST['artiste'])  // Vérifie si le champ 'artiste' est vide
    || empty($_POST['description'])  // Vérifie si le champ 'description' est vide
    || empty($_POST['image'])  // Vérifie si le champ 'image' est vide
    || strlen($_POST['description']) < 3  // Vérifie que la description contient au moins 3 caractères
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL) // Vérifie que l'URL de l'image est valide
    || !preg_match('/\.(jpg|jpeg|png|gif)$/i', $_POST['image']) // Vérifie que l'URL de l'image finit par une extension d'image valide
) {
    // Si une des conditions échoue, redirige l'utilisateur vers ajouter.php avec le paramètre 'erreur=true'
    header('Location: ajouter.php?erreur=true');
} else {
    // Si toutes les conditions sont respectées, on sécurise les données
    $titre = htmlspecialchars($_POST['titre']); // Sécurise le titre pour éviter les injections XSS
    $description = htmlspecialchars($_POST['description']); // Sécurise la description pour éviter les injections XSS
    $artiste = htmlspecialchars($_POST['artiste']); // Sécurise le nom de l'artiste
    $image = htmlspecialchars($_POST['image']);  // Sécurise l'URL de l'image

    // Puis on insère notre oeuvre en base de données / Est-ce qu'on redirige l'user vers la page d'accueil?

    // ... (code pour insérer l'oeuvre en base de données ici)

    // Redirection de l'utilisateur vers la page d'accueil avec son oeuvre et insérer message confirmation
}

require_once(__DIR__.'/footer.php'); ?>
