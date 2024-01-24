<?php ob_start() ?>

"page erreur";

<?php
$titre = "Contenu introuvable";
$content = ob_get_clean();
require "template.view.php";
