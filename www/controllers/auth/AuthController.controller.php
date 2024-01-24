<?php

abstract class AuthController
{
    protected function setAuth(User $user)
    {
        if ($user != null) {
            foreach ($user as $attribut => $valeur) {
                $_SESSION['user'][$attribut] = $valeur;
            }
        }
    }
}
