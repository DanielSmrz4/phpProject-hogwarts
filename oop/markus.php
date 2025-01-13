<?php

// logika
class Book {

    const MAX_PRICE = 1500;
    const MIN_PRICE = 100;
    
    function __construct($title, $author, $year){
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }


    function description() {
        return "Název knihy: " . $this->title . "<br>Autor: " . $this->author . "<br>Rok vydání: " . $this->year;
    }

    function changePriceAmount($amount) {
        $result = $this->price += $amount;
    }

    function changePricePercentage($percentage) {
        $result = $this->price += $this->price / 100 * $percentage;
    }

}

class Car {

    function __construct($color, $brand) {
        $this->color = $color;        
        $this->brand = $brand;
        $this->seats = 4;
    }
}

// použití
$car1 = new Car("red", "audi");
echo $car1->color;
