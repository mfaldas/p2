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
$tip = 1;
#$tip =  isset($_GET['tip']) ? $_GET['tip'] : '';

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

if ($calcS < 0.01) {
    echo @"Cannot split bill due to low bill.";
} else {
    dump( $splitter->splitWays($billWithTip, $split, $calcS) );
}



