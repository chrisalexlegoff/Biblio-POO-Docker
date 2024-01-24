<?php
require_once "models/utils/ConnexionManager.class.php";
require_once "User.class.php";

class UsersManager extends ConnexionManager
{

    private User $user;

    public function setUser(string $identifiant, $password)
    {
        $req = $this->getConnexionBdd()->prepare("SELECT * FROM user");
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($users as $user) {
            if ($user['identifiant'] === $identifiant) {
                if (password_verify($password, $user['password'])) {
                    $user = new User($user['id_user'], $user['identifiant'], $user['password']);
                    return $this->user = $user;
                }
            }
        }
        return null;
    }

    /**
     * Get the value of user
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
