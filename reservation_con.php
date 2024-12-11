<?php
include_once "../config.php";
include_once "../Model/reservation.php";

class ReservationController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    public function add_reservation($reservation) {
        try {
            $query = $this->db->prepare('INSERT INTO reservation (id, nb_place, date, event_id) 
                VALUES (:id, :nb_place, :date, :event_id)');
            
            $query->execute([
                'id' => $reservation->get_id(),
                'nb_place' => $reservation->get_nb_place(),
                'date' => $reservation->get_date(),
                'event_id' => $reservation->get_event_id()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function show_reservation($id) {
        try {
            $query = $this->db->prepare('SELECT * FROM reservation WHERE id = :id');
            $query->execute(['id' => $id]);
            $reservation = $query->fetch();
            
            if($reservation) {
                return new Reservation(
                    $reservation['id'],
                    $reservation['nb_place'],
                    $reservation['date'],
                    $reservation['event_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function list_reservations() {
        try {
            $query = $this->db->prepare('SELECT * FROM reservation');
            $query->execute();
            $reservations = [];
            
            while($reservation = $query->fetch()) {
                $reservations[] = new Reservation(
                    $reservation['id'],
                    $reservation['nb_place'],
                    $reservation['date'],
                    $reservation['event_id']
                );
            }
            return $reservations;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function update_reservation($reservation) {
        try {
            $query = $this->db->prepare('UPDATE reservation SET 
                nb_place = :nb_place,
                date = :date,
                event_id = :event_id
                WHERE id = :id');
                
            $query->execute([
                'id' => $reservation->get_id(),
                'nb_place' => $reservation->get_nb_place(),
                'date' => $reservation->get_date(),
                'event_id' => $reservation->get_event_id()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function delete_reservation($id) {
        try {
            $query = $this->db->prepare('DELETE FROM reservation WHERE id = :id');
            $query->execute(['id' => $id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
