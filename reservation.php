<?php

class Reservation {
    private string $id;
    private int $nb_place;
    private string $date;
    private string $event_id;

    public function __construct($id, $nb_place, $date, $event_id) {
        $this->id = $id;
        $this->nb_place = $nb_place;
        $this->date = $date;
        $this->event_id = $event_id;
    }

    // Getters
    public function get_id() {
        return $this->id;
    }

    public function get_nb_place() {
        return $this->nb_place;
    }

    public function get_date() {
        return $this->date;
    }

    public function get_event_id() {
        return $this->event_id;
    }

    // Setters
    public function set_id($val) {
        $this->id = $val;
    }

    public function set_nb_place($val) {
        $this->nb_place = $val;
    }

    public function set_date($val) {
        $this->date = $val;
    }

    public function set_event_id($val) {
        $this->event_id = $val;
    }
}
?>
