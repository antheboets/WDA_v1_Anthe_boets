<?php
    class Address{
        public $id;
        public $city;
        public $street;
        public $number;
        public $zip;

        public function __construct($id, $city, $street, $number, $zip)
        {
            $this->id = $id;
            $this->city = $city;
            $this->street = $street;
            $this->number = $number;
            $this->zip = $zip;
        }


    }
?>