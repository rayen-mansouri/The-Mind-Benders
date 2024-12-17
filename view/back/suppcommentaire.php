<?php
include '../../controller/conseilC.php';
include '../../controller/commentaireC.php'; // Include commentaireC

if (isset($_GET["id_cmnt"])) {
    $id_comnt = $_GET["id_cmnt"];
    
    $commentaireC = new commentaireC();
    $commentaireC->supprimer($id_comnt);
    header('Location: affichecommentaire.php');
    exit();
} else {
    header('Location: affichecommentaire.php?error=missing_id');
    exit();
}
?>
