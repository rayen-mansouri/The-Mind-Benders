<?php
class Commentaire {
    private $id_cmnt;    // Primary Key
    private $contenu;    // Text of the comment
    private $date_pub;   // Publication date of the comment
    private $id_con;     // Foreign Key referencing 'conseilc'

    // Constructor
    public function __construct($id_cmnt = null, $contenu = null, $date_pub = null, $id_con = null) {
        $this->id_cmnt = $id_cmnt;
        $this->contenu = $contenu;
        $this->date_pub = $date_pub;
        $this->id_con = $id_con;
    }

    // Getter and Setter for id_cmnt
    public function getIdCmnt() {
        return $this->id_cmnt;
    }

    public function setIdCmnt($id_cmnt) {
        $this->id_cmnt = $id_cmnt;
    }

    // Getter and Setter for contenu
    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    // Getter and Setter for date_pub
    public function getDatePub() {
        return $this->date_pub;
    }

    public function setDatePub($date_pub) {
        $this->date_pub = $date_pub;
    }

    // Getter and Setter for id_con
    public function getIdCon() {
        return $this->id_con;
    }

    public function setIdCon($id_con) {
        $this->id_con = $id_con;
    }
    // Getter and Setter for LIKES
    public function getLikes() {
        return $this->likes;
    }

    public function setLikes($likes) {
        $this->likes= $likes;
    }
}
?>
