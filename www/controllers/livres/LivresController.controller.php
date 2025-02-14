<?php
require_once "models/livres/LivreManager.class.php";
require_once "models/utils/Utils.class.php";

class LivresController
{
    private LivreManager $livreManager;

    public function __construct()
    {
        $this->livreManager = new LivreManager;
        if (isset($_SESSION['user']))
            $this->livreManager->chargementLivres($_SESSION['user']['id']);
    }

    public function afficherLivres()
    {
        $livresTab = $this->livreManager->getLivres();
        (count($livresTab) > 0) ? $pasDeLivre = false : $pasDeLivre = true;
        require "views/livres.view.php";
        unset($_SESSION['alert']);
    }

    public function afficherLivre($id)
    {
        $livre = $this->livreManager->getLivreById($id);
        ($livre != null) ? require "views/afficherLivre.view.php" : require "views/error.view.php";
    }

    public function afficherLivresAccueil()
    {
        $livresTab = $this->livreManager->getAllLivres();
        (count($livresTab) > 0) ? $pasDeLivre = false : $pasDeLivre = true;
        require "views/accueil.view.php";
    }

    public function ajoutLivre()
    {
        require "views/ajoutLivre.view.php";
    }

    public function ajoutLivreValidation()
    {
        $image = $_FILES['image'];
        $repertoire = "public/images/";
        $cheminImage = Utils::ajoutImage($image, $repertoire);
        $this->livreManager->ajoutLivreBd($_POST['titre'], $_POST['nbPages'], $cheminImage);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];
        header('Location: ' . URL . "livres");
    }

    public function suppressionLivre($id_livre)
    {
        $nomImage = $this->livreManager->getLivreById($id_livre)->getImage();
        unlink("public/images/" . $nomImage);
        $this->livreManager->suppressionLivreBD($id_livre);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];

        header('Location: ' . URL . "livres");
    }

    public function modifierLivre($id_livre)
    {
        $livre = $this->livreManager->getLivreById($id_livre);
        require "views/modifierLivre.view.php";
    }

    public function modificationLivreValidation()
    {
        $imageActuelle = $this->livreManager->getLivreById(intval($_POST['id_livre']))->getImage();
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            unlink("public/images/" . $imageActuelle);
            $repertoire = "public/images/";
            $nomImageToAdd = Utils::ajoutImage($file, $repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->livreManager->modificationLivreBd(intval($_POST['id_livre']), $_POST['titre'], intval($_POST['nbPages']), $nomImageToAdd);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "modification Réalisée"
        ];
        header('Location: ' . URL . "livres");
    }
}
