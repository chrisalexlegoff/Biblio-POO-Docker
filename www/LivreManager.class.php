<?php
require_once "ConnexionManager.class.php";
require_once "Livre.class.php";

class LivreManager extends ConnexionManager
{

    // attributs
    private array $livres;

    // Méthode d'ajout de livre
    public function ajouterLivre(object $nouveauLivre)
    {
        $this->livres[] = $nouveauLivre;
    }

    public function chargementLivres()
    {
        $req = $this->getConnexionBdd()->prepare("SELECT * FROM livre");
        $req->execute();
        $livresImportes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($livresImportes as $livre) {
            $nouveauLivre = new Livre($livre['id_livre'], $livre['titre'], $livre['nb_pages'], $livre['image']);
            $this->ajouterLivre($nouveauLivre);
        }
    }

    /**
     * Get the value of livres
     *
     * @return array
     */
    public function getLivres(): array
    {
        return $this->livres;
    }
}
