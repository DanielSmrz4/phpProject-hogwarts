<?php

// Abstrakce

class Ucet {
    protected $pin;

    function __construct($first_name, $second_name, $pin){
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->pin = $pin;
    }

    function create_income(){

    }

    function create_expanse(){
        
    }

    static function description(){
        echo "Na vašem účtu je zůstatek: 10 000 Kč.";
    }
}

class Bankaccount extends Ucet {

}

class Saveaccount extends Ucet {

}

class Businessacount extends Ucet {
    static function description(){
        // echo "Na vašem podnikatelském účtu je zůstatek: 20 000 Kč";
        echo parent::description() . " Podnikatelé u nás mají vždy dveře otevřené.";
    }
}


// $account1 = new Bankaccount("David", "Šetek", 1234);
Ucet::description();