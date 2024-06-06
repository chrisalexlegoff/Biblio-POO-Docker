<?php
require_once "models/users/UsersManager.class.php";
require_once "services/auth/AuthController.controller.php";

class UsersController extends AuthController
{
    private UsersManager $usersManager;

    public function __construct()
    {
        $this->usersManager = new usersManager;
    }

    public function connexion(string $identifiant, string $password)
    {
        $user = $this->usersManager->setUser($identifiant, $password);
        if ($user !== null) {
            $this->setAuth($user);
            header('location: livres');
        }
    }

    public function deconnexion()
    {
        session_destroy();
        header('location: /');
    }
}
