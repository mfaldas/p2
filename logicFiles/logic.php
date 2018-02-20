<?php

/**
 * logic.php
 * The logic component to the display file.  Uses the Form.php from DWA15 lecture
 * and an extension of the class called MyForm.php that has includes more functionalities
 * that correspond to the needs of the application.  Logic file also uses a class called
 * Splitter.php that calculates the split and reports the results of the split.
 * Created and Modified By: Marc-Eli Faldas
 * Last Modified: 2/20/2018
 */

require $_SERVER['DOCUMENT_ROOT'] . "/classes/Splitter.php";
require $_SERVER['DOCUMENT_ROOT'] . "/classes/Form.php";
require $_SERVER['DOCUMENT_ROOT'] . "/classes/MyForm.php";

use BillSplitter\Splitter;
use Faldas\MyForm;

$form = new MyForm($_GET);

//Variable Descriptions and Default Values
$split = $form->get("split", ""); //How Many People to Split Amongst
$bill = $form->get("bill", ""); //Bill from User
$tip = isset($_GET["tip"]) ? $_GET["tip"] : "1"; //How Much Tip
$roundUp = $form->has("roundUp"); //Round to the nearest dollar Ex. $1.10 -> $2.00, $1.60->2.00, $1.00 -> $1.00
$initiateCalculation = false; //Boolean to determine to stay on the "Stand div Welcome" or to start Calculation
$validCalculation = true; //Boolean to see if the split bill for everyone is greater than $0.01

if ($split == "" && $bill == "" && $tip = "1") {
    $initiateCalculation = false; //Base Case
} else {
    $initiateCalculation = true;
}

//Reports Any Problems with User Input
if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            "bill" => "moneyFormat|required",
            "split" => "numeric|min:0|max:100|required",
        ]
    );
}

//Creates Splitter
$splitter = new Splitter($split, $bill, $tip, $roundUp);

$billWithTip = $splitter->getBillWithTip();
$calcS = $splitter->calculatedSplit($billWithTip);

//Creates an array with people who pay normal and how many pay extra by 1 cent
//Ex. 9.99/4 = 1 person owes 2.49 and 3 people owe $2.50
$splitBetween = $splitter->splitWays($billWithTip, $calcS);

if ($calcS < 0.01) {
    $validCalculation = false;
} else {
    if ($roundUp == true) {
        $splitBetween = $splitter->roundWhole($splitBetween);
    }
}

//Gets string of results to print out to the user.
$printResults = $splitter->resultMaker($splitBetween);



