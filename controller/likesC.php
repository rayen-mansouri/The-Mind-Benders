<?php
// Inclure la configuration et la connexion à la base de données
include_once '../../config.php';

class VoteController
{
    // Fonction pour récupérer les votes (likes/dislikes) pour un commentaire spécifique
    public function getVotesByComment($id_cmnt)
    {
        try {
            $pdo = Database::getConnexion();  // Remplacez 'config' par 'Database'
            $query = $pdo->prepare("
                SELECT 
                    SUM(type_like = 'like') AS total_likes, 
                    SUM(type_like = 'dislike') AS total_dislikes
                FROM likes 
                WHERE id_cmnt = :id_cmnt
            ");
            $query->execute(['id_cmnt' => $id_cmnt]);
            return $query->fetch(PDO::FETCH_ASSOC); // Retourner les résultats sous forme associative
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Fonction pour gérer les votes (like ou dislike)
    public function incrementVote($id_cmnt, $voteType, $user_id)
    {
        try {
            $pdo = Database::getConnexion();  // Remplacez 'config' par 'Database'

            // Vérifier si l'utilisateur a déjà voté
            $query = $pdo->prepare("
                SELECT * 
                FROM likes 
                WHERE id_cmnt = :id_cmnt AND user_id = :user_id
            ");
            $query->execute(['id_cmnt' => $id_cmnt, 'user_id' => $user_id]);
            $existingVote = $query->fetch(PDO::FETCH_ASSOC);

            if ($existingVote) {
                // Si l'utilisateur a déjà voté, on met à jour uniquement si le type est différent
                if ($existingVote['type_like'] !== $voteType) {
                    $update = $pdo->prepare("
                        UPDATE likes 
                        SET type_like = :voteType, date_like = NOW() 
                        WHERE id_cmnt = :id_cmnt AND user_id = :user_id
                    ");
                    $update->execute([
                        'voteType' => $voteType,
                        'id_cmnt' => $id_cmnt,
                        'user_id' => $user_id,
                    ]);
                }
            } else {
                // Si l'utilisateur n'a pas encore voté, insérer un nouveau vote
                $insert = $pdo->prepare("
                    INSERT INTO likes (id_cmnt, type_like, user_id) 
                    VALUES (:id_cmnt, :voteType, :user_id)
                ");
                $insert->execute([
                    'id_cmnt' => $id_cmnt,
                    'voteType' => $voteType,
                    'user_id' => $user_id,
                ]);
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>
