<?php
// Inclure la configuration et la connexion à la base de données
include_once '../config.php';
include_once '../controller/commentaireC.php';// Adapter selon votre structure de projet
include '../model/likes.php'; // Si nécessaire


class VoteController
{
    // Fonction pour récupérer les votes (likes/dislikes) pour un commentaire spécifique
    public function getVotesByComment($id_cmnt)
    {
        try {
            $this->createVoteIfNotExists($id_cmnt); // Créer une entrée si elle n'existe pas encore
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT 
                                        SUM(type_like = 'like') AS total_likes, 
                                        SUM(type_like = 'dislike') AS total_dislikes
                                     FROM likes WHERE id_cmnt = :id_cmnt");
            $query->execute(['id_cmnt' => $id_cmnt]);
            return $query->fetch(PDO::FETCH_ASSOC); // Récupérer les résultats sous forme associative
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    

    // Fonction pour incrémenter le vote (like/dislike)
    public function incrementVote($id_cmnt, $voteType, $user_id)
{
    try {
        $pdo = config::getConnexion();
        
        // Vérifier si l'utilisateur a déjà voté
        $query = $pdo->prepare("SELECT * FROM likes WHERE id_cmnt = :id_cmnt AND user_id = :user_id");
        $query->execute(['id_cmnt' => $id_cmnt, 'user_id' => $user_id]);
        $existingVote = $query->fetch(PDO::FETCH_ASSOC);

        if ($existingVote) {
            // Mettre à jour le vote si l'utilisateur a déjà voté
            $update = $pdo->prepare("UPDATE likes SET type_like = :voteType, date_like = NOW() WHERE id_cmnt = :id_cmnt AND user_id = :user_id");
            $update->execute(['voteType' => $voteType, 'id_cmnt' => $id_cmnt, 'user_id' => $user_id]);
        } else {
            // Ajouter un nouveau vote
            $insert = $pdo->prepare("INSERT INTO likes (id_cmnt, type_like, user_id) VALUES (:id_cmnt, :voteType, :user_id)");
            $insert->execute(['id_cmnt' => $id_cmnt, 'voteType' => $voteType, 'user_id' => $user_id]);
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

    // Fonction pour créer un enregistrement de vote s'il n'existe pas
    public function createVoteIfNotExists($id_cmnt)
    {
        try {
            $pdo = config::getConnexion();
            // Assurez-vous qu'il y a une entrée pour le commentaire dans la table des votes (likes et dislikes)
            $query = $pdo->prepare("INSERT IGNORE INTO likes (id_cmnt, type_like, user_id) VALUES (:id_cmnt, 'like', NULL)");
            $query->execute(['id_cmnt' => $id_cmnt]);
            $query = $pdo->prepare("INSERT IGNORE INTO likes (id_cmnt, type_like, user_id) VALUES (:id_cmnt, 'dislike', NULL)");
            $query->execute(['id_cmnt' => $id_cmnt]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>
