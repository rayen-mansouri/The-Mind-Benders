<?php

class Partner {

    private string $id, $name, $address, $email;

    public function __construct($id, $name, $address, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
    }

    // Getter and Setter for ID
    public function set_id($val) {
        $this->id = $val;
    }

    public function get_id() {
        return $this->id;
    }

    // Getter and Setter for Name
    public function set_name($val) {
        $this->name = $val;
    }

    public function get_name() {
        return $this->name;
    }

    // Getter and Setter for Address
    public function set_address($val) {
        $this->address = $val;
    }

    public function get_address() {
        return $this->address;
    }

    // Getter and Setter for Email
    public function set_email($val) {
        $this->email = $val;
    }

    public function get_email() {
        return $this->email;
    }

}

?>
