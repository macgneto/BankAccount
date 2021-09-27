<?php

    abstract class BankAccount{

        protected $Balance = 0;

        public $APR;

        public $SortCode;

        public $FirstName;

        public $LastName;

        public $Audit = array();

        protected $Locked = false;


        //Methods

        public function WithDraw( $amount ){

            $transDate = new DateTime();
            if ( $this->Locked === false ) {

                $this->Balance -= $amount;

                array_push( $this->Audit, array( "WITHDRAW ACCEPTED", $amount, $this->Balance, $transDate->format('c') ) );

            } else {

                array_push( $this->Audit, array( "WITHDRAW DENIED", $amount, $this->Balance, $transDate->format('c') ) );

            }

        }


        public function Deposit( $amount ){

            $transDate = new DateTime();
            if ( $this->Locked === false ) {

                $this->Balance += $amount;

                array_push( $this->Audit, array( "DEPOSIT ACCEPTED", $amount, $this->Balance, $transDate->format('c') ) );

            } else {

                array_push( $this->Audit, array( "DEPOSIT DENIED", $amount, $this->Balance, $transDate->format('c') ) );

            }

        }


        public function Lock(){

            $this->Locked = true;

            $lockedDate = new DateTime();

            array_push( $this->Audit, array( "ACCOUNT LOCKED", $lockedDate->format('c') ) );

        }


        public function Unlock(){

            $this->Locked = false;

            $unlockedDate = new DateTime();

            array_push( $this->Audit, array( "ACCOUNT UNLOCKED", $unlockedDate->format('c') ) );

        }

    }

