<?php

class LivreManager
{

    // attributs
    private array $livres;

    // Méthode d'ajout de livre
    public function ajouterLivre(object $nouveauLivre)
    {
        $this->livres[] = $nouveauLivre;
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
