<?php

class Utils
{
    public static function ajoutImage($image, $dir)
    {
        if (!isset($image['name']) || empty($image['name']))
            throw new Exception("Vous devez indiquer une image");

        if (!file_exists($dir)) mkdir($dir, 0777);

        $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $random = rand(0, 99999);
        $target_image = $dir . $random . "_" . $image['name'];

        if (!getimagesize($image["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if (file_exists($target_image))
            throw new Exception("Le fichier existe déjà");
        if ($image['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if (!move_uploaded_file($image['tmp_name'], $target_image))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random . "_" . $image['name']);
    }
}
