<?php
/**
 * Created by PhpStorm.
 * User: marc-elifaldas
 * Date: 2/13/18
 * Time: 6:51 AM
 */

$split = isset($_GET['split']) ? $_GET['split'] : '';
#echo @$split;

$bill = isset($_GET['bill']) ? $_GET['bill'] : '';

if (!is_numeric($bill)) {


    echo @"Please enter a valid input.";


} else {

    if ( !strpos($bill, ".") ) {
        $bill = intval($bill);

    } else {

        $splicedBill = explode(".",$bill);
        $checkDecimal = $splicedBill[1];

        if (strlen($checkDecimal) <= 2) {
            $bill = floatval($bill);
        } else {
            echo @"Please enter a valid input.";

        }
    }
}

echo @$bill . " ";

$n = floatval($bill/$split);

if ($n < 0.01) {
    echo "Girl, this be too small.";
}


$n = intval(($n*100))/100;
$calculatedTotal = $n * $split;



if ($bill == $calculatedTotal) {
    echo @" Girl, you got dis.";
} else {
    echo @" Girl hold up.";

    $difference = $bill - $calculatedTotal;
    $payExtra = $difference/0.01;
    $payNormal = $split - $payExtra;

    echo " ". $payExtra;

    $extraSplit = $n + 0.01;


    echo " " . $payExtra . " pay " . $extraSplit;
    echo " " . $payNormal . " pay " . $n;
}









/**
$splitString = $_GET['split'];
dump($splitString);
$splitInt = intval($splitInt);
echo $splitInt;
dump(is_int (23));

$n = float($bill);
$whole = floor($n);      // 1
$fraction = $n - $whole;
@var To check if has . or .1 or .10 $check
$check = string($fraction);

if (strlen($check) <= 3) {
    $bill = float($bill);
} else {
    echo @"Please enter a valid input.";
}