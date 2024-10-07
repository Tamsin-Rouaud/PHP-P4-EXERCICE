<?php require_once(__DIR__.'/header.php');; ?>

<!-- Vérification de la présence d'une erreur dans l'URL et affichage d'un message -->
<?php if (isset($_GET['erreur']) && $_GET['erreur'] == 'true'): ?>
    <p style="color: red;">Veuillez compléter tous les champs correctement et fournir une URL d'image valide.</p>
<?php endif; ?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" required> <!-- Ajout de l'attribut 'required' pour forcer le remplissage -->
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" required> <!-- Ajout de 'required' -->
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" required> <!-- Ajout de 'required' et type 'url' pour une meilleure validation -->
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea> <!-- Ajout de 'required' -->
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require_once(__DIR__.'/footer.php'); ?>

