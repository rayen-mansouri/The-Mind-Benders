<?php

class LikeModel {
    private $id_like;
    private $id_cmnt;
    private $type_like;
    private $user_id;
    private $date_like;

    // Getter et Setter pour id_like
    public function getIdLike() {
        return $this->id_like;
    }

    public function setIdLike($id_like) {
        $this->id_like = $id_like;
    }

    // Getter et Setter pour id_cmnt
    public function getIdCmnt() {
        return $this->id_cmnt;
    }

    public function setIdCmnt($id_cmnt) {
        $this->id_cmnt = $id_cmnt;
    }

    // Getter et Setter pour type_like
    public function getTypeLike() {
        return $this->type_like;
    }

    public function setTypeLike($type_like) {
        $this->type_like = $type_like;
    }

    // Getter et Setter pour user_id
    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    // Getter et Setter pour date_like
    public function getDateLike() {
        return $this->date_like;
    }

    public function setDateLike($date_like) {
        $this->date_like = $date_like;
    }
}
