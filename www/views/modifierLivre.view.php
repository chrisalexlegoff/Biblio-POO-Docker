<?php ob_start() ?>

<form method="POST" action="<?= URL ?>livres/mv" enctype="multipart/form-data" id="form-modification-livre" onSubmit="return confirm('Voulez-vous vraiment modifier le livre <?= $livre->getTitre(); ?> ?');">
    <div class="form-group my-4">
        <label for="titre">Titre : </label>
        <input type="text" value="<?= $livre->getTitre() ?>" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group my-4">
        <label for="nbPages">Nombre de pages : </label>
        <input type="number" value="<?= $livre->getNbPages() ?>" class="form-control" id="nbPages" name="nbPages">
    </div>
    <div id="preview" class="mt-2 mb-2">
        <img src="<?= URL . "public/images/" . $livre->getImage() ?>" alt="<?= $livre->getImage() ?>">
    </div>
    <div class="form-group my-4">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="id_livre" value="<?= $livre->getId() ?>">
    <button type="submit" id="upload-image" class="btn btn-primary">Valider</button>
</form>


<?php
$titre = "Modification du livre n° " . $livre->getId();
$content = ob_get_clean();
require "template.view.php";
