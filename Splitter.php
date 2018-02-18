<?php

namespace BillSplitter;

class Splitter {

    private $split; #How many people to split amongst.  Value should be of type int().
    private $bill; #The total bill.  Value should be of type float().
    private $tip; #How much tip is being offered.  Value should be of type float().
    private $roundUp; #If the bill should be rounded up.  Value should be of type bool().



    /*
     * Magic Methods to Construct
     */
    public function __construct($s, $b, $t, $r) {

        $this->split = $s;
        $this->bill = $b;
        $this->tip = $t;
        $this->roundUp = $r;

    }

    public function splitWays($b, $s, $cS) {

        $regularSplit = intval(($cS*100))/100;
        $calculatedTotal = $regularSplit * $s;

        if ($b  == $calculatedTotal) {
            return [(string)$s, $regularSplit, "0", "0"];
        } else {

            $difference = $b - $calculatedTotal;
            $payExtra =  round( $difference/0.01 );
            $payNormal = $s - $payExtra;
            $extraSplit = $regularSplit + 0.01;

            return [(string)$payNormal, (string)$regularSplit, (string)$payExtra, (string)$extraSplit];

        }
    }

    public function calculatedSplit ($b, $s) {

        return floatval($b/$s);
    }

    public function getBillWithTip() {

        return round( $this->bill*$this->tip , 2);
    }
}
