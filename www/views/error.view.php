<?php ob_start() ?>

<?= $msg; ?>

<?php
$titre = "Contenu introuvable";
$content = ob_get_clean();
require "template.view.php";
