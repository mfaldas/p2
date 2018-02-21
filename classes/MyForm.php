<?php
/**
 * MyForm.php
 * An extension/child of the Form.php classes.  MyForm validates if the bill input is a valid form
 * of USD currency.  getErrorMessage() was modified to present the error to the validation.
 * Created by: Marc-Eli Faldas
 * Last Modified: 2/17/2018
 */

namespace Faldas;

use DWA\Form;

class MyForm extends Form
{

    /**
     * Method that checks if the input is of USD money format.  Valid and invalid examples
     * are shown below.
     * @param $b : The user input bill.
     * @return bool: If the user input is valid input. (Ex. Valid inputs include
     * $0.01, $0.1 which is interpreted by the program as 0.10, 1. which is interpreted
     * as 1.00.  Invalid input includes 0.001 and 4.321.)
     */
    protected function moneyFormat($b)
    {
        if (!$this->initialBillValidity($b)) {
            return false;
        } else {
            if (!$this->secondaryBillValidity($b)) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Method used by the moneyFormat method.  Checks if the bill user input in question
     * is numeric and is not a negative number.
     * @param $test : User input bill in question.  If passes the first test, $test goes
     * to nested secondaryBillValidity method to see if input is totally correct.
     * @return bool: Returns false if the bill in question is non numeric or a negative value.
     */
    private function initialBillValidity($test)
    {
        if (!is_numeric($test)) {
            return false;
        } else if (floatval($test) <= 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Nested method to see if the bill input in question is valid.  Valid inputs include
     * whole numbers/ints (ex. 2) and floats with maximum two places after the decimal (ex. 0.1 which is interpreted
     * by the program as 0.10, 1. which is interpreted as $1.00.  Invalid input includes $0.001 and $4.321.)  Note
     * that the "1." is considered valued input as user could have by accident put a decimal after an intended whole
     * number.
     * @param $test
     * @return bool
     */
    private function secondaryBillValidity($test)
    {
        if (!strpos($test, ".")) {
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
     * Given a String rule like "alphaNumeric" or "required"
     * It"ll return a String message appropriate for that rule
     * Default message is used if no message is set for a given rule
     * Added an error message for moneyFormat error.  Modified numeric to say
     * say only positive whole numbers can be used.
     * @param $rule
     * @param null $parameter
     * @return mixed|string
     * Created by: Susan Buck
     * Modified by: Marc-Eli Faldas
     * Last Modified: 2/17/2018
     */
    protected function getErrorMessage($rule, $parameter = null)
    {
        $language = [
            "alphaNumeric" => " can only contain letters or numbers.",
            "alpha" => " can only contain letters.",
            "numeric" => " can only contain positive whole numbers.",
            "required" => " can not be blank.",
            "email" => " is not a valid email address.",
            "min" => " has to be greater than " . $parameter . ".",
            "max" => " has to be less than " . $parameter . ".",
            "moneyFormat" => " has to be in USD currency format.",
        ];

        # If a message for the rule was found, use that, otherwise default to " has an error"
        $message = isset($language[$rule]) ? $language[$rule] : " has an error.";

        return $message;
    }
}

