<?php
include_once '../controller/likesC.php';

if (isset($_POST['id_cmnt']) && isset($_POST['voteType'])) {
    $id_cmnt = $_POST['id_cmnt'];
    $voteType = $_POST['voteType'];
    $user_id = 1; // Remplacer par l'ID de l'utilisateur actuel, s'il est connecté.

    $voteController = new VoteController();
    $voteController->incrementVote($id_cmnt, $voteType, $user_id);

    // Récupérer les résultats des votes
    $votes = $voteController->getVotesByComment($id_cmnt);

    echo json_encode($votes); // Retourner les résultats sous forme de JSON
}
?>
