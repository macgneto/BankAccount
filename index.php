<?php

class Bank {


    private $Balance = 550;

    public function WithDraw($amount){

        $x = $this->Balance - $amount;
        echo $x;

    }
}

$account1 = new Bank();
$account1->WithDraw(200);


echo "</br>";

$account2 = new Bank();
$account2->WithDraw(100);

// Testing of this is an instance of interface
//if ( this instanceof fileInt) {
//
//    this.Read("input");
//
//}