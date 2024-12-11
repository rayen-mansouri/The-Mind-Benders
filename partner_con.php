<?php

require_once __DIR__ . '/../config.php';

class partnerCon {

    private $tab_name;

    public function __construct($tab_name) {
        $this->tab_name = $tab_name;
    }

    // Get a single Partner by ID
    public function getPartner($id) {
        $sql = "SELECT * FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $partner = $query->fetch();
            return $partner;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // List all Partners
    public function listPartners() {
        $sql = "SELECT * FROM $this->tab_name";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new Partner
    public function addPartner($partner) {
        $sql = "INSERT INTO $this->tab_name(name, address, email) VALUES (:name, :address, :email)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $partner->get_name(),
                'address' => $partner->get_address(),
                'email' => $partner->get_email()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing Partner
    public function updatePartner($partner, $id) {
        $sql = "UPDATE $this->tab_name SET name = :name, address = :address, email = :email WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'name' => $partner->get_name(),
                'address' => $partner->get_address(),
                'email' => $partner->get_email()
            ]);
            echo $query->rowCount() . " records UPDATED successfully<br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Delete a Partner by ID
    public function deletePartner($id) {
        $sql = "DELETE FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>
