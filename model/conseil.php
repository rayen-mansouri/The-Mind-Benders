<?php

class Conseil {

    private ?int $id_con = null;
    private ?string $contenu = null;
    private ?\DateTime $date_pub = null;

    // Constructor
    public function __construct(?int $id_con = null, ?string $contenu = null, $date_pub = null) {
        $this->id_con = $id_con;
        $this->contenu = $contenu;
    
        if (is_string($date_pub)) {
            try {
                $this->date_pub = new \DateTime($date_pub);
            } catch (\Exception $e) {
                $this->date_pub = null; 
            }
        } else {
            $this->date_pub = $date_pub;   //0
        }
    }
    
    // Getter and Setter for $id_con
    public function getIdCon(): ?int {
        return $this->id_con;
    }

    public function setIdCon(?int $id_con): void {
        $this->id_con = $id_con;
    }

    // Getter and Setter for $contenu
    public function getContenu(): ?string {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): void {
        $this->contenu = $contenu;
    }

    // Getter and Setter for $date_pub
    public function getDatePub(): ?\DateTime {
        return $this->date_pub;
    }
    
    public function setDatePub(?\DateTime $date_pub): void {
        $this->date_pub = $date_pub;
    }

   
}
