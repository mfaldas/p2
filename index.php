<?php
require 'helpers.php';
require 'logic.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Selena Gomez</title>
</head>
<body>

<h1>I've been running through the Jungle</h1>

<form method='GET' action='index.php'>

    <label>Split:
        <input type='number' name='split' min="1" max="99" value='<?=sanitize($split)?>'>
    </label>

    <br>

    <label>Bill:
        <input type='text' name='bill' value='<?=sanitize($bill)?>'>
    </label>

    <input type="submit" value="Split it Girl" name="submit">

</form>


</body>
</html>