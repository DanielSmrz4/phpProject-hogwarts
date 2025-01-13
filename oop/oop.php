<?php 

// --- 4 principy OOP ---
// Zapouzdření (encapsulation)
// - private = atributy a metody jsou přístupné pouze uvnitř hlavní classy, nejsou k dispozici v classe, která dědí
// - protected = atributy a metody jsou přístupné v hlavní classe i v classach, které z hlavní dědí
// - public = atributy a metody jsou přístupné i mimo classu (zvenčí)

// Abstrakce (abstraction)

// Dědičnost (dědičnost)

// Polymorfismus (plomorphism)


// logika
class BankAccount {
    private $pin;

    function __construct($first_name, $second_name, $pin){
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->pin = $pin;
        $this->income = 0;
        $this->expense = 0;
        $this->movements = [];
    }


    function pin_checker($user_pin){
        if ($user_pin !== $this->pin){
            header("Location: http://localhost/www2databaze/oop/wrong-pin.php");
            exit();
        }
    }

    function create_income($amount){
        $this->income += $amount;
        $this->add_movement($amount);
    }

    function create_expense($amount){
        $this->expense += $amount;
        $this->add_movement($amount);
    }

    private function add_movement($money){
        $this->movements[] = $money;
    }
}

// použití
$account1 = new BankAccount("David", "Šetek", 1234);
