<?php
class User
{
    public int $id;
    public string $identifiant;
    private string $password;
    public bool $isValide;

    public function __construct(int $id, string $identifiant, string $password)
    {
        $this->id = $id;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->isValide = false;
    }
}
