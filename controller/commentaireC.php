<?php
include_once '../config.php';

class commentaireC {
    // Fetch comments for a specific conseil
    public function afficherCommentaires($id_con) {
        try {
            $sql = "SELECT * FROM commentair WHERE id_con = :id_con";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->bindValue(':id_con', $id_con, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Add a new comment
    public function ajouterCommentaire($id_con, $contenu) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("INSERT INTO commentair (id_con, contenu, date_pub) VALUES (:id_con, :contenu, NOW())");
            $query->execute(['id_con' => $id_con, 'contenu' => $contenu]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Fetch all comments with optional sorting
    public function afficherTousCommentaires($tri = 'id_cmnt') {
        try {
            $db = config::getConnexion();
            // Validate sort criteria
            $allowedSorts = ['id_cmnt', 'date_pub'];
            if (!in_array($tri, $allowedSorts)) {
                $tri = 'id_cmnt';
            }

            $sql = "SELECT * FROM commentair ORDER BY $tri DESC";
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Delete a comment by ID
    public function supprimer($id_comnt) {
        try {
            $db = config::getConnexion();
            $sql = "DELETE FROM commentair WHERE id_cmnt = :id_cmnt";
            $query = $db->prepare($sql);
            $query->execute(['id_cmnt' => $id_comnt]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Update a comment
    public function updateCommentaire($id_cmnt, $contenu) {
        try {
            $db = config::getConnexion();
            $query = "UPDATE commentair SET contenu = :contenu WHERE id_cmnt = :id_cmnt";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_cmnt', $id_cmnt, PDO::PARAM_INT);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    // Get a comment by ID
    public function getCommentaireById($id_cmnt) {
        try {
            $db = config::getConnexion();
            $query = "SELECT * FROM commentair WHERE id_cmnt = :id_cmnt";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_cmnt', $id_cmnt, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
