<?php

class Event{

    private string $id, $titre, $desc, $date, $prix;
    private ?string $partner_id;
    private int $places_nbr;

    public function __construct($id, $titre, $desc, $date, $prix, ?string $partner_id, $places_nbr){
        $this->id = $id;
        $this->titre = $titre;
        $this->desc = $desc;
        $this->date = $date;
        $this->prix = $prix;
        $this->partner_id = $partner_id;
        $this->places_nbr = $places_nbr;
    }
    

    public function set_id($val){
        $this->id = $val;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_titre($val){
        $this->titre = $val;
    }

    public function get_titre(){
        return $this->titre;
    }

    public function set_desc($val){
        $this->desc = $val;
    }

    public function get_desc(){
        return $this->desc;
    }

    public function set_date($val){
        $this->date = $val;
    }

    public function get_date(){
        return $this->date;
    }

    public function set_prix($val){
        $this->prix = $val;
    }

    public function get_prix(){
        return $this->prix;
    }

    public function set_places_nbr($val){
        $this->places_nbr = $val;
    }

    public function get_places_nbr(){
        return $this->places_nbr;
    }

    public function set_partner_id(?string $val){
        $this->partner_id = $val;
    }

    public function get_partner_id(){
        return $this->partner_id;
    }

}

?>