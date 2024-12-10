<?php
include_once '../controller/likesC.php';

// Vérifier si les paramètres nécessaires sont présents
if (isset($_POST['id_cmnt']) && isset($_POST['voteType'])) {
    $id_cmnt = $_POST['id_cmnt'];
    $voteType = $_POST['voteType'];
    $user_id = 1; // Remplacer par l'ID réel de l'utilisateur connecté, via session ou autre méthode

    // Instancier le contrôleur de votes
    $voteController = new VoteController();

    // Traiter le vote
    if ($voteType === 'like' || $voteType === 'dislike') {
        $voteController->incrementVote($id_cmnt, $voteType, $user_id);
    } else {
        echo json_encode(['error' => 'Type de vote invalide.']);
        exit;
    }

    // Récupérer les totaux des votes pour mise à jour dynamique
    $votes = $voteController->getVotesByComment($id_cmnt);

    // Retourner les résultats sous forme de JSON
    echo json_encode($votes);
} else {
    // Gérer les erreurs lorsque les paramètres sont manquants
    echo json_encode(['error' => 'Paramètres manquants.']);
    exit;
}
?>
