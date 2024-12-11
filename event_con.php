<?php

require_once __DIR__ . '/../config.php';

class eventCon{

    private $tab_name;
    private $db;

    public function __construct($tab_name){
        $this->tab_name = $tab_name;
        $this->db = config::getConnexion();
    }

    public function getEvent($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE id = $id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listEvents()
    {
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        
        try {
            $pdo = config::getConnexion();
            $query = "SELECT * FROM $this->tab_name";
            
            // Add sorting
            switch($sort) {
                case 'date':
                    $query .= " ORDER BY date " . $order;
                    break;
                case 'titre':
                    $query .= " ORDER BY titre " . $order;
                    break;
                case 'prix':
                    $query .= " ORDER BY prix " . $order;
                    break;
                default:
                    $query .= " ORDER BY date " . $order;
            }
            
            $liste = $pdo->query($query);
            return $liste->fetchAll();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addEvent($event)
    {
        $sql = "INSERT INTO $this->tab_name(titre, description, date, prix, partner_id, places_nbr) VALUES (:titre, :desc, :date, :prix, :partner_id, :places_nbr)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(
                [
                    'titre' => $event->get_titre(),
                    'desc' => $event->get_desc(),
                    'date' => $event->get_date(),
                    'prix' => $event->get_prix(),
                    'partner_id' => $event->get_partner_id(),
                    'places_nbr' => $event->get_places_nbr()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateEvent($event, $id)
    {
        try {
            $sql = "UPDATE $this->tab_name SET titre = :titre, description = :desc, date = :date, prix = :prix, partner_id = :partner_id, places_nbr = :places_nbr WHERE id = :id";
            $query = $this->db->prepare($sql);
            $query->execute(
                [
                    'id' => $id,
                    'titre' => $event->get_titre(),
                    'desc' => $event->get_desc(),
                    'date' => $event->get_date(),
                    'prix' => $event->get_prix(),
                    'partner_id' => $event->get_partner_id(),
                    'places_nbr' => $event->get_places_nbr()
                ]
            );
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }

    function deleteEvent($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE id = :id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getEventStats()
    {
        try {
            // Total events
            $sql_total = "SELECT COUNT(*) as total FROM $this->tab_name";
            $result_total = $this->db->query($sql_total);
            $total_events = $result_total->fetch()['total'];

            // Average places and total places
            $sql_places = "SELECT AVG(places_nbr) as avg_places, SUM(places_nbr) as total_places FROM $this->tab_name";
            $result_places = $this->db->query($sql_places);
            $places_stats = $result_places->fetch();

            // Events by price range
            $sql_price_ranges = "SELECT 
                CASE 
                    WHEN prix <= 50 THEN 'Budget (≤50)'
                    WHEN prix <= 100 THEN 'Mid-range (51-100)'
                    ELSE 'Premium (>100)'
                END as price_range,
                COUNT(*) as count
                FROM $this->tab_name
                GROUP BY price_range
                ORDER BY MIN(prix)";
            $result_price_ranges = $this->db->query($sql_price_ranges);
            $price_ranges = $result_price_ranges->fetchAll();

            return [
                'total_events' => $total_events,
                'avg_places' => round($places_stats['avg_places'], 1),
                'total_places' => $places_stats['total_places'],
                'price_ranges' => $price_ranges
            ];
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function updatePlacesNumber($eventId, $reservedPlaces)
    {
        try {
            $sql = "UPDATE $this->tab_name SET places_nbr = places_nbr - :reserved_places WHERE id = :event_id AND places_nbr >= :reserved_places";
            $query = $this->db->prepare($sql);
            $query->execute([
                'reserved_places' => $reservedPlaces,
                'event_id' => $eventId
            ]);
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateLikes($eventId, $increment = true) {
        $sql = "UPDATE $this->tab_name SET likes = likes " . ($increment ? "+ 1" : "- 1") . " WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $eventId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateDislikes($eventId, $increment = true) {
        $sql = "UPDATE $this->tab_name SET dislikes = dislikes " . ($increment ? "+ 1" : "- 1") . " WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $eventId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function toggleFavorite($eventId) {
        $sql = "UPDATE $this->tab_name SET is_fav = NOT is_fav WHERE id = :id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $eventId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}


?>