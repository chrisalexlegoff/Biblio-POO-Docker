<?php
ob_start();

if (!empty($_SESSION['alert'])) :
?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
        <?= $_SESSION['alert']['msg'] ?>
    </div>
<?php
endif;
?>

<?php if ($pasDeLivre === false) : ?>
    <table class="table text-center">
        <tr class="table-dark">
            <th>Image</th>
            <th>Titre</th>
            <th>Nombre de pages</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php
        foreach ($livresTab as $livre) : ?>
            <a href="#">
                <tr>
                    <td class="align-middle"><img src="public/images/<?= $livre->getImage(); ?>" style="height: 60px;"></td>
                    <td class="align-middle">
                        <a href="<?= URL ?>livres/l/<?= $livre->getId(); ?>">
                            <?= $livre->getTitre(); ?>
                        </a>
                    </td>
                    <td class="align-middle"><?= $livre->getNbPages(); ?></td>
                    <td class="align-middle">
                        <a href="<?= URL ?>livres/m/<?= $livre->getId(); ?>" class="btn btn-warning">Modifier</a>
                    </td>
                    <td class="align-middle">
                        <form method="POST" action="<?= URL ?>livres/s/<?= $livre->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre <?= $livre->getTitre(); ?> ?');">
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            </a>
        <?php endforeach; ?>
    </table>
    <a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>
<?php else : ?>
    <div class="d-flex flex-column">
        <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
            <div class="card-header">Votre espace</div>
            <div class="card-body">
                <h4 class="card-title">Désolé</h4>
                <p class="card-text">Il semble que vous n'ayez pas encore uploader de livre dans votre espace.</p>
                <p class="card-text">Pour y remédier, utilisez le bouton ci-dessous...</p>
            </div>
        </div>
        <a href="" class="btn btn-success">Ajouter</a>
    </div>
<?php endif; ?>

<?php
$titre = "Gérer vos livres";
$content = ob_get_clean();
require "template.view.php";
