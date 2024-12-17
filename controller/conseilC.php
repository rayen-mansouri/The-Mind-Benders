<?php

include_once '../../config.php';  // Assurez-vous que le chemin est correct
include '../../model/conseil.php';

class conseilC
{
    public function afficher()
    {
        $sql = "SELECT * FROM conseil ORDER BY date_pub DESC"; 
        
        // Utilisez la classe Database au lieu de config
        $db = Database::getConnexion();  
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function supprimer($id_con)
    {
        $sql = "DELETE FROM conseil WHERE id_con = :id_con";
        // Utilisez la classe Database au lieu de config
        $db = Database::getConnexion();  
        $req = $db->prepare($sql);
        $req->bindValue(':id_con', $id_con);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function ajouter($conseil)
    {
        $sql = "INSERT INTO conseil (id_con, contenu, date_pub) VALUES (:id_con, :contenu, :date_pub)";
        // Utilisez la classe Database au lieu de config
        $db = Database::getConnexion();  
        try {
            $query = $db->prepare($sql);
            
            // Convert DateTime object to string format (Y-m-d)
            $date_pub = $conseil->getDatePub() ? $conseil->getDatePub()->format('Y-m-d') : null;

            // Execute the query with the converted date
            $query->execute([
                'id_con' => $conseil->getIdCon(),
                'contenu' => $conseil->getContenu(),
                'date_pub' => $date_pub
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function recupererconseil($id_con) {
        $sql = "SELECT * FROM conseil WHERE id_con = :id_con";
        // Utilisez la classe Database au lieu de config
        $db = Database::getConnexion();  
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_con' => $id_con]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    public function modifierconseil($conseil) {
        $sql = "UPDATE conseil SET contenu = :contenu, date_pub = :date_pub WHERE id_con = :id_con";
        // Utilisez la classe Database au lieu de config
        $db = Database::getConnexion();  
        try {
            $query = $db->prepare($sql);

            // Convert DateTime
            $date_pub = $conseil->getDatePub() ? $conseil->getDatePub()->format('Y-m-d') : null;

            // Execute the query 
            $query->execute([
                'id_con' => $conseil->getIdCon(),
                'contenu' => $conseil->getContenu(),
                'date_pub' => $date_pub
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>
