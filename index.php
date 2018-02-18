<?php
require 'helpers.php';
require 'logic.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Selena Gomez</title>
    <meta charset='utf-8'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
          rel='stylesheet' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm'
          crossorigin='anonymous'>
</head>
<body>

<h1>I've been running through the Jungle</h1>

<form method='GET' action='index.php'>

    <label>Split:
        <input type='text' name='split'>
    </label>

    <br>

    <label>Bill:
        <input type='text' name='bill' value='<?=sanitize($bill)?>'>
    </label>

    <select name="Tip">
        <option value="1">No Tip</option>
        <option value="1.10">10% Tip</option>
        <option value="1.15">15% Tip</option>
        <option value="1.20">20% Tip</option>
    </select>
    <br><br>


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
<?php endif; ?>


</body>
</html>