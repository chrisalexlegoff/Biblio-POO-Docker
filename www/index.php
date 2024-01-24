<?php
session_start();

// constante URL
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/livres/LivresController.controller.php";
require_once "controllers/users/UsersController.controller.php";
$livresController = new LivresController;
$usersController = new usersController;

try {
    if (empty($_GET['page'])) {
        $livresController->afficherLivresAccueil();;
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case 'accueil':
                $livresController->afficherLivresAccueil();
                break;
            case 'livres':
                if (empty($url[1])) {
                    $livresController->afficherLivres();
                } else if ($url[1] === "l") {
                    $livresController->afficherLivre(intval($url[2]));
                } else if ($url[1] === "a") {
                    $livresController->ajoutLivre();
                } else if ($url[1] === "m") {
                    echo "modifier un livre";
                } else if ($url[1] === "s") {
                    $livresController->suppressionLivre(intval($url[2]));
                } else if ($url[1] === "av") {
                    $livresController->ajoutLivreValidation();
                } else {
                    throw new Exception("La page n'existe pas");
                }
                break;
            case 'connexion':
                (!isset($_SESSION['user'])) ? require "views/connexion.view.php" : require "views/livres.view.php";
                break;
            case 'deconnexion':
                $usersController->deconnexion();
                break;
            default:
                throw new Exception("La page n'existe pas");
                break;
        }
    }
} catch (Exception $e) {
    // echo $e->getMessage();
    require "views/error.view.php";
}
