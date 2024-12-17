<?php
include_once '../../controller/commentaireC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'id du commentaire et le contenu sont présents
    if (isset($_POST['id_cmnt']) && isset($_POST['contenu'])) {
        $id_cmnt = $_POST['id_cmnt'];
        $contenu = $_POST['contenu'];

        // Mettre à jour le commentaire dans la base de données
        $commentaireC = new commentaireC();
        $commentaireC->updateCommentaire($id_cmnt, $contenu);

        // Rediriger vers la page précédente ou une autre page après la mise à jour
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Erreur : données manquantes.";
    }
}
?>
