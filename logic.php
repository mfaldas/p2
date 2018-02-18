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

$split = $form->get('split', '');
$bill = $form->get('bill', '');
$tip =  isset($_GET['tip']) ? $_GET['tip'] : '';
$roundUp = $form->has('roundUp');
$validCalculation = true;

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'bill' => 'moneyFormat',
            'split' => 'numeric|min:0|max:100',
        ]
    );
}

$splitter = new Splitter($split, $bill, $tip, true);

$billWithTip = $splitter->getBillWithTip();
$calcS = $splitter->calculatedSplit($billWithTip, $split);
$splitBetween = $splitter->splitWays($billWithTip, $split, $calcS);


if ($calcS < 0.01) {
    $validCalculation = false;
} else {

    if ($roundUp == true) {
        $splitBetween = $splitter->roundWhole($splitBetween);
    }
}

$printResults = $splitter->resultMaker($splitBetween);



