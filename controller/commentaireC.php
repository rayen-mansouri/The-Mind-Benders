<?php
include_once '../config.php';
include_once '../model/cmn.php';

class commentaireC {
    // Fetch comments for a specific conseil
    public function afficherCommentaires($id_con)
{
    // Suppression de la clause ORDER BY
    $sql = "SELECT * FROM commentair WHERE id_con = :id_con";
    $db = config::getConnexion();
    $query = $db->prepare($sql);
    $query->bindValue(':id_con', $id_con, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}

    // Add a new comment
    public function ajouterCommentaire($id_con, $contenu) {
        $db = config::getConnexion();
        $query = $db->prepare("INSERT INTO commentair (id_con, contenu, date_pub) VALUES (:id_con, :contenu, NOW())");
        $query->execute(['id_con' => $id_con, 'contenu' => $contenu]);
    }
    
    public function afficherTousCommentaires($tri = 'id_cmnt') {
        try {
            $db = config::getConnexion();
    
            // Vérifier si le critère de tri est valide, sinon utiliser 'id_cmnt' par défaut
            $tri = in_array($tri, ['id_cmnt', 'date_pub']) ? $tri : 'id_cmnt';
    
            // Construire la requête avec le tri
            $sql = "SELECT * FROM commentair ORDER BY $tri DESC";
            
            // Exécuter la requête
            $query = $db->query($sql);
    
            // Retourner tous les commentaires sous forme de tableau
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
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
    
    
        // Existing methods...
    
        public function updateCommentaire($id_cmnt, $contenu) {
            // Connexion à la base de données
            $db = config::getConnexion();  // Use the correct connection method here
            $query = "UPDATE commentair SET contenu = :contenu WHERE id_cmnt = :id_cmnt";
            $stmt = $db->prepare($query);
            
            // Lier les paramètres
            $stmt->bindParam(':id_cmnt', $id_cmnt);
            $stmt->bindParam(':contenu', $contenu);
            
            // Exécuter la requête
            $stmt->execute();
        }
        
    
        // Get a comment by ID
        public function getCommentaireById($id_cmnt) {
            $db = config::getConnexion();  // Obtenir la connexion à la DB
            $query = "SELECT * FROM commentair WHERE id_cmnt = :id_cmnt";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_cmnt', $id_cmnt);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    ?>

    
    
    
    
    
    
    
    
    
                
       
    


  
    
}

?>
