<?php
class User
{
    private int $id;
    private string $identifiant;
    private string $password;
    private array $roles;
    private bool $isValide;

    public function __construct(int $id, string $identifiant, string $password)
    {
        $this->id = $id;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->isValide = false;
    }
}
