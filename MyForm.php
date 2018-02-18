<?php

namespace Faldas;

require ('Form.php');
use DWA\Form;


class MyForm extends Form{

    protected function moneyFormat($b) {

        if ( !$this->initialBillValidity($b) ) {
            return false;
        } else {

            if (!$this->secondaryBillValidity($b)) {
                return false;
            } else {
                return true;
            }
        }
    }

    private function initialBillValidity($test) {

        if (!is_numeric($test)) {
            return false;
        } elseif (floatval($test) <= 0 ) {
            return false;
        } else {
            return true;
        }
    }

    private function secondaryBillValidity($test) {

        if ( !strpos($test,'.')) {
            return true;
        } else {
            $splicedTest = explode(".", $test);
            $checkDecimal = $splicedTest[1];

            if (strlen($checkDecimal) <= 2) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Given a String rule like 'alphaNumeric' or 'required'
     * It'll return a String message appropriate for that rule
     * Default message is used if no message is set for a given rule
     * @param $rule
     * @param null $parameter
     * @return mixed|string
     */
    protected function getErrorMessage($rule, $parameter = null)
    {
        $language = [
            'alphaNumeric' => ' can only contain letters or numbers.',
            'alpha' => ' can only contain letters.',
            'numeric' => ' can only contain numbers.',
            'required' => ' can not be blank.',
            'email' => ' is not a valid email address.',
            'min' => ' has to be greater than ' . $parameter . '.',
            'max' => ' has to be less than ' . $parameter . '.',
            'moneyFormat' => ' has to be in USD currency format.',
        ];

        # If a message for the rule was found, use that, otherwise default to " has an error"
        $message = isset($language[$rule]) ? $language[$rule] : ' has an error.';

        return $message;
    }

}

