<?php
require_once "models/utils/ConnexionManager.class.php";
require_once "Livre.class.php";

class LivreManager extends ConnexionManager
{

    // attributs
    private array $livres = [];

    // Méthode d'ajout de livre
    public function ajouterLivre(object $nouveauLivre)
    {
        $this->livres[] = $nouveauLivre;
    }

    public function chargementLivres($idUser)
    {
        $req = $this->getConnexionBdd()->prepare("SELECT * FROM livre where id_user=$idUser");
        $req->execute();
        $livresImportes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($livresImportes as $livre) {
            $nouveauLivre = new Livre($livre['id_livre'], $livre['titre'], $livre['nb_pages'], $livre['image']);
            $this->ajouterLivre($nouveauLivre);
        }
    }

    public function getLivreById($id)
    {
        foreach ($this->livres as $livre) {
            if ($livre->getId() === $id) return $livre;
        }
    }

    public function ajoutLivreBd($titre, $nbPages, $image)
    {
        $req = "
        INSERT INTO livre (titre, nb_pages, image, id_user)
        values (:titre, :nbPages, :image, :id_user)";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":id_user", $_SESSION['user']['id'], PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $livre = new Livre($this->getConnexionBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajouterLivre($livre);
        }
    }

    public function suppressionLivreBD($id_livre)
    {
        $req = "DELETE FROM livre WHERE id_livre = :idLivre";
        $stmt = $this->getConnexionBdd()->prepare($req);
        $stmt->bindValue(":idLivre", $id_livre, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $livre = $this->getLivreById($id_livre);
            unset($livre);
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
