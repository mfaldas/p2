<?php
/**
 * Created by PhpStorm.
 * User: marc-elifaldas
 * Date: 2/13/18
 * Time: 6:51 AM
 */

require ('Splitter.php');
require('MyForm.php');

use BillSplitter\Splitter;
use Faldas\MyForm;


$form = new MyForm($_GET);

$split = $form->get('split', ''); //How Many People to Split Amongst
$bill = $form->get('bill', ''); //Bill from User
$tip =  isset($_GET['tip']) ? $_GET['tip'] : '1'; //How Much Tip
$roundUp = $form->has('roundUp'); //Round to the nearest dollar Ex. 1.10 -> 2, 1.60->2, 1 ->1
$initiateCalculation = false; //Boolean to determine to stay on the standard welcome or to start calculation
$validCalculation = true; //If the splitted bill for everyone is greater than $0.01

if ($split == '' && $bill == '' && $tip='1') {
    $initiateCalculation = false; //Base Case
} else {
    $initiateCalculation = true;
}

//Reports any problems with input
if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'bill' => 'moneyFormat',
            'split' => 'numeric|min:0|max:100',
        ]
    );
}

//Creates a splitter object that does many calculations
$splitter = new Splitter($split, $bill, $tip, true);

$billWithTip = $splitter->getBillWithTip(); //Calculates bill with tip
$calcS = $splitter->calculatedSplit($billWithTip, $split); //Calculates split
$splitBetween = $splitter->splitWays($billWithTip, $split, $calcS); //Creates an array with people who pay normal and how many pay extra by 1 cent ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50


if ($calcS < 0.01) {
    $validCalculation = false;
} else {

    if ($roundUp == true) {
        $splitBetween = $splitter->roundWhole($splitBetween);
    }
}

$printResults = $splitter->resultMaker($splitBetween); //Gets strings with results



