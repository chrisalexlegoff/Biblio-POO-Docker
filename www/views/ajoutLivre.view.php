<?php ob_start() ?>

<form method="POST" action="<?= URL ?>livres/av" enctype="multipart/form-data">
    <div class="form-group my-4">
        <label for="titre">Titre : </label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group my-4">
        <label for="nbPages">Nombre de pages : </label>
        <input type="number" class="form-control" id="nbPages" name="nbPages">
    </div>
    <div class="form-group my-4">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$titre = "Ajout d'un livre";
$content = ob_get_clean();
require "template.view.php";
