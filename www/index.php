<?php ob_start() ?>

Ici le contenu de ma page d'accueil.

<?php
$titre = "Bibliothèque de Christophe";
$content = ob_get_clean();
require "template.php";
