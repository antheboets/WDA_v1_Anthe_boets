<?php
    class User{

        public $id;
        public $email;
        public $firstName;
        public $lastName;
        public $shoppingCart;
        public $admin;

        public function __construct($id, $email, $firstName, $lastName, $shoppingCart, $admin)
        {
            $this->id = $id;
            $this->email = $email;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->shoppingCart = $shoppingCart;
            $this->admin = $admin;
        }


    }

?>