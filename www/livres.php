<?php
require_once 'Livre.class.php';
require_once "LivreManager.class.php";

$livreManager = new LivreManager;
$livreManager->chargementLivres();

ob_start() ?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
    $livresTab = $livreManager->getLivres();
    foreach ($livresTab as $livre) : ?>
        <tr>
            <td class="align-middle"><img src="public/images/<?= $livre->getImage(); ?>" style="height: 60px;"></td>
            <td class="align-middle"><?= $livre->getTitre(); ?></td>
            <td class="align-middle"><?= $livre->getNbPages(); ?></td>
            <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
            <td class="align-middle"><a href="" class="btn btn-danger">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="" class="btn btn-success d-block">Ajouter</a>

<?php
$titre = "Liste des livres";
$content = ob_get_clean();
require "template.php";
