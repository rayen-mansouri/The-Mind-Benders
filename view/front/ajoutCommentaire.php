<?php
include '../../controller/commentaireC.php';
include_once '../../controller/likesC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $id_con = $_POST['id_con']; // ID of the conseil being commented on
    $contenu = $_POST['contenu']; // Content of the comment

    // Ensure the data is valid
    if (!empty($id_con) && !empty($contenu)) {
        // Instantiate the Commentaire Controller
        $commentaireC = new commentaireC();

        // Add the comment to the database
        $commentaireC->ajouterCommentaire($id_con, $contenu);

        // Redirect back to the conseil.php page
        header("Location: indexconseil.php");
        exit;
    } else {
        // Redirect with an error message if data is invalid
        header("Location: indexconseil.php?error=missing_fields");
        exit;    
    }
}
?>
