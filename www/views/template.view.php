<?php
require_once "controllers/users/UsersController.controller.php";
$usersController = new UsersController;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#upload-image").click(function() {
                $("#form-modification-livre").ajaxForm({
                    target: '.preview'
                }).submit();
            });

            function imagePreview(fileInput) {
                if (fileInput.files && fileInput.files[0]) {
                    var fileReader = new FileReader();
                    fileReader.onload = function(event) {
                        $('#preview').html('<img src="' + event.target.result + '"/>');
                    };
                    fileReader.readAsDataURL(fileInput.files[0]);
                }
            }
            $("#image").change(function() {
                imagePreview(this);
            });
        });
    </script>
    <title>Biblio | <?= $titre ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Biblio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>connexion">Se connecter</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>livres">Gestion-livres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= URL ?>deconnexion">Se déconnecter</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div id="container" class="m-2">
        <h1 class="rounded border border-dark p-2 text-center text-white bg-info"><?= $titre ?></h1>
        <div class="d-flex flex-wrap justify-content-center"> <?= $content ?></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>