<?php

    require ("BankAccount.php");

    class ISA extends BankAccount {

        public $TimePeriod = 28;

        public $AdditionalServices;

        //Methods

        public function WithDraw( $amount ){

            $transDate = new DateTime();

            if ( $this->Locked === false ) {

                $lastTransaction = null;

                $length = count($this->Audit);

                for ( $i = $length, $i > 0; $i-- ){

                    $element = $this->Audit[$i - 1];

                    if ( $element[0] === "WITHDRAW ACCEPTED" ) {

                        $days = new DateTime( $element[3] );

                        $lastTransaction = $days->diff($transDate)->format("%a");

                        break;

                    }

                }

                if ( $lastTransaction === null && $this->Locked === false || $this->Locked === false && $lastTransaction > $this->TimePeriod){

                    $this->Balance -= $amount;

                    array_push( $this->Audit, array ( "WITHDRAW ACCEPTED", $amount, $this->Balance, $transDate->format('c') ) );

                } else {

                    if( $this->Locked === false ) {

                        $this->Balance -= $amount;

                        array_push( $this->Audit, array("WITHDRAW ACCEPTED WITH PENALTY", $amount, $this->Balance, $transDate->format('c') ) );

                        $this->Penalty();

                    } else {

                        array_push( $this->Audit, array( "WITHDRAW DENIED", $amount, $this->Balance, $transDate->format('c') ) );

                    }

                }

            }

            private function Penalty(){

                $transDate = new DateTime();

                $this->Balance -= 10;

                array_push( $this->Audit, array( "WITHDRAW PENALTY", 10, $this->Balance, $transDate->format('c') ) );

            }

        }






    }