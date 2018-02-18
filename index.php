<?php
require 'helpers.php';
require 'logic.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Katy Perry's Bill Splitter</title>
    <meta charset='utf-8'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
          rel='stylesheet' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm'
          crossorigin='anonymous'>

    <link href='p2Style.css' rel='stylesheet'>

</head>
<body>

<div class="parent">

    <h1>I've been running through the Jungle</h1>

    <form method='GET' action='index.php'>

        <label>Split:
            <input type='text' name='split'>
        </label>

    <br>

        <label>Bill:
            <input type='text' name='bill' value='<?=sanitize($bill)?>'>
        </label>

        <label>Tip:
            <select name="tip">
                <option value="1">No Tip</option>
                <option value="1.10">10% Tip</option>
                <option value="1.15">15% Tip</option>
                <option value="1.20">20% Tip</option>
            </select>
        </label>

    <br>
    <br>

        <label>Round Up
            <input type='checkbox' name='roundUp' value='1' <?=($roundUp) ? 'checked' : ''?>>
        </label>

        <input type="submit" value="Split it Girl" name="submit">

    </form>

    <?php if ($form->hasErrors) : ?>
        <div class='alert alert-danger'>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?=$error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php elseif (!$validCalculation) : ?>
        <div class='alert alert-danger'>
            Unable to make calculation as the split bill would be less than $0.01.
        </div>

    <?php else : ?>
        <div class="alert alert-success">
            <?=$printResults?>
        </div>

    <?php endif; ?>

</div>




</body>
</html>