<?php
include '../controller/conseilC.php';
include '../controller/commentaireC.php';

$s = new conseilC();
$c = new commentaireC();

// Afficher les conseils
$tab = $s->afficher();

// Gérer les commentaires soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_con = $_POST['id_con'];
    $contenu = $_POST['contenu'];
    $date = date("Y-m-d");

    $c->ajouterCommentaire([
        'id_con' => $id_con,
        'contenu' => $contenu,
        'dat_cmnt' => $date,
    ]);

    header("Location: " . $_SERVER['PHP_SELF']); // Rafraîchir la page
    exit;
}

// Afficher les commentaires
function afficherCommentaires($id_con)
{
    global $c;
    return $c->getCommentairesParConseil($id_con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils & Commentaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2>Nos Conseils :</h2>
    <div class="row">
        <?php foreach ($tab as $conseil): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Conseil du <?= $conseil['date_pub'] ?></h5>
                        <p class="card-text"><?= $conseil['contenu'] ?></p>

                        <!-- Formulaire de commentaire -->
                        <form method="post">
                            <input type="hidden" name="id_con" value="<?= $conseil['id_con'] ?>">
                            <div class="mb-3">
                                <textarea name="contenu" class="form-control" rows="3" placeholder="Ajouter un commentaire"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Poster le commentaire</button>
                        </form>

                        <!-- Affichage des commentaires -->
                        <div class="mt-3">
                            <h6>Commentaires :</h6>
                            <?php $commentaires = afficherCommentaires($conseil['id_con']); ?>
                            <?php if (count($commentaires) > 0): ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($commentaires as $commentaire): ?>
                                        <li class="list-group-item">
                                            <?= $commentaire['contenu'] ?> <br>
                                            <small class="text-muted">Publié le <?= $commentaire['dat_cmnt'] ?></small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">Aucun commentaire pour l'instant.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
