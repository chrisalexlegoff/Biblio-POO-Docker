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
    }

    public function afficherLivre($id)
    {
        $livre = $this->livreManager->getLivreById($id);
        ($livre != null) ? require "views/afficherLivre.view.php" : require "views/error.view.php";
    }

    public function afficherLivresAccueil()
    {
        $livresTab = $this->livreManager->getLivres();
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
        header('Location: ' . URL . "livres");
    }

    public function suppressionLivre($id_livre)
    {
        $nomImage = $this->livreManager->getLivreById($id_livre)->getImage();
        unlink("public/images/" . $nomImage);
        $this->livreManager->suppressionLivreBD($id_livre);
        header('Location: ' . URL . "livres");
    }
}
