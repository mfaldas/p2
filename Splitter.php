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

    public function roundWhole($a){

        $a[1] = number_format(ceil( floatval($a[1]) ), 2, '.', '');
        $a[3] = number_format(ceil( floatval($a[3]) ), 2, '.', '');

        return $a;
    }

    //My algorithim for the splitting of the bill.
    public function splitWays($b, $s, $cS) {

        $regularSplit = intval(($cS*100))/100;
        $calculatedTotal = $regularSplit * $s;

        if ($b  == $calculatedTotal) {

            $cSString = number_format((float)$cS, 2, '.', '');
            return [(string)$s, $cSString, "0", "0.00"];
        } else {

            $difference = $b - $calculatedTotal;
            $payExtra =  round( $difference/0.01 );
            $payNormal = $s - $payExtra;
            $extraSplit = $regularSplit + 0.01;

            $regularSplitString = number_format((float)$regularSplit, 2, '.', '');
            $extraSplitString = number_format((float)$extraSplit, 2, '.', '');

            return [(string)$payNormal, $regularSplitString, (string)$payExtra, $extraSplitString];

        }
    }

    public function calculatedSplit ($b, $s) {

        return floatval($b/$s);
    }

    public function getBillWithTip() {

        return round( $this->bill*$this->tip , 2);
    }

    public function resultMaker($a) {

        if (floatVal($a[1]) == floatVal($a[3])) {
            return "Everyone owes $" . $a[1] . ".";
        }
        elseif ( floatVal($a[0]) == 1 && floatVal($a[2]) == 0 ) {
            return "1 person owes $" . $a[1] . ".";
        }
        elseif ( floatVal($a[0]) > 1 && floatVal($a[2]) == 0 ) {
            return "Everyone owes $" . $a[1] . ".";
        }
        elseif ( floatVal($a[0]) == 1 && floatVal($a[2]) > 1 ) {
            return $a[0] . " person owes $" . $a[1] . " and " . $a[2] . " people owe $" . $a[3] . ".";
        }
        elseif ( floatVal($a[0]) > 1 && floatVal($a[2]) == 1 ) {
            return $a[0] . " people owe $" . $a[1] . " and " . $a[2] . " person owes $" . $a[3] . ".";
        }
        else {
            return $a[0] . " people owe $" . $a[1] . " and " . $a[2] . " people owe $" . $a[3] . ".";
        }
    }
}
