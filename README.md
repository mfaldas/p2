# Project 2
+ By: Marc-Eli Faldas
+ Production URL: <http://p2.dwa15marcelifaldas.win>

## Outside Resources

**Images**

Background Image "_KatyPerry.jpg": <https://wallpaperscraft.com/download/katy_perry_table_girl_smile_brunette_85339/3840x2160#>

Katy Perry Logo "_KatyPerryLogo.png": <http://logonoid.com/katy-perry-logo/>

**Code References**

Opacity Code for Parent Div: <https://stackoverflow.com/questions/3969380/achieving-white-opacity-effect-in-html-css>

```
    background-color: rgba(255, 255, 255, 0.5);
```

Bill Splitter Algorithim Insipiration: <https://stackoverflow.com/questions/3918567/splitting-the-bill-algorithmically-fair-afterwards>

Code from Forum:

```
total_cents = 100 * total;
base_amount = Floor(total_cents / num_people);
cents_short = total_cents - base_amount * num_people;
while (cents_short > 0)
{
    // add one cent to a random person
    cents_short--;
}
```

My Code:
```
$s = $this->split;
$regularSplit = intval(($cS * 100)) / 100;
$calculatedTotal = $regularSplit * $s;

if ($b == $calculatedTotal) {
        $cSString = number_format((float)$cS, 2, ".", "");

        return [(string)$s, $cSString, "0", "0.00"];
    } else {
        $difference = $b - $calculatedTotal;
        $payExtra = round($difference / 0.01);  //How many people will pay extra 1 cent
        $payNormal = $s - $payExtra; //How many people will pay the normal payment
        $extraSplit = $regularSplit + 0.01;
```

The code from the Stack Overflow mostly served as a jumping off point of logic as opposed to a copy of the code.

Connecting Files from Different Directories: <https://stackoverflow.com/questions/13394924/php-serverdocument-root>

```
require($_SERVER['DOCUMENT_ROOT'] . "/classes/Splitter.php");
require($_SERVER['DOCUMENT_ROOT'] . "/classes/Form.php");
require($_SERVER['DOCUMENT_ROOT'] . "/classes/MyForm.php");
```

Form.php (Code from Lecture): <https://github.com/susanBuck/foobooks0/blob/461624fef8d6da25baefb2b8b808fd4c8abc1e3f/Form.php>

Changed getErrorMessage($rule, $parameter = null) from private to protected to have child class inherit the method and modify it.

```
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
        ];
        # If a message for the rule was found, use that, otherwise default to " has an error"
        $message = isset($language[$rule]) ? $language[$rule] : ' has an error.';
        return $message;
    }
```

Helpers.php (Code from Lecture): <https://github.com/susanBuck/foobooks0/blob/master/helpers.php>


## Code Style Divergences
Line 93 of index.php has characters more than 180 characters as it is a description for the user.

## Notes for Instructor

Please note the following:
* Both text input values are prefilled.  As such, user input will be sanitizied.
* Split value field only accepts int values from 1-99.
* Bill value field accepts ints and floats.  Acceptable float values include "0.01", "0.1", "1".
* Uses Design C with GET.
