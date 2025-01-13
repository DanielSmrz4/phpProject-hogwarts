<?php

class Bankaccount {
    private $pin;
    private $balance;

    function __construct($first_name, $second_name, $pin){
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->setPin($pin);
        $this->balance = 500;
    }

    // Setter
    public function setPin($pin){
        if (strlen((strval($pin))) === 4){
            $this->pin = $pin;
        } else {
            throw new Exception("Neplatný pin");
        }       
    }

    // Getter
    public function getBalance(){
        return $this->balance;
    }

}

// Použití
$account = new Bankaccount("Daniel", "Smrž", 4444);
echo $account->getBalance();
