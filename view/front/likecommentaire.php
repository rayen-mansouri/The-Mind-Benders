<?php
include '../../controller/commentaireC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the comment ID is set
    if (isset($_POST['id_cmnt'])) {
        // Instantiate the controller
        $commentaireC = new commentaireC();
        
        // Call the like method to increment likes for the comment
        $commentaireC->likeComment($_POST['id_cmnt']);
        
        // Redirect back to the comments page
        header("Location: indexconseil.php");
        exit();
    } else {
        // Handle error, comment ID is missing
        header("Location: indexconseil.php?error=missing_comment_id");
        exit();
    }
}
?>
