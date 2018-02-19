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

    <img src='/images/_KatyPerryLogo.png' alt='Katy Perry Logo' name='kpl'>
    <h1>Bill Splitter</h1>

    <br>

    <form method='GET' action='index.php'>

        <div class="row">

            <div class="col-sm-6">
                <label>Split:
                    <input type='text' name='split' class='splitTextBox' value='<?= sanitize($split) ?>' required>
                </label>

                <br>

                <label>Bill: $
                    <input type='text' name='bill' class='billTextBox' value='<?= sanitize($bill) ?>' required>
                </label>
            </div>

            <div class="col-sm-3">
                <label class='tipLabel'>Tip:
                    <select name="tip" class='tipDropdown'>
                        <option value="1" <?php if ($_GET['tip'] == 't') echo 'selected="selected"'; ?>>No Tip</option>
                        <option value="1.10" <?php if ($_GET['tip'] == '1.10') echo 'selected="selected"'; ?>>10% Tip</option>
                        <option value="1.15" <?php if ($_GET['tip'] == '1.15') echo 'selected="selected"'; ?>>15% Tip</option>
                        <option value="1.20" <?php if ($_GET['tip'] == '1.20') echo 'selected="selected"'; ?>>20% Tip</option>
                    </select>
                </label>
            </div>

            <div class="col-sm-3">
                <label>Round Up:
                    <input type='checkbox' name='roundUp' value='1' <?= ($roundUp) ? 'checked' : '' ?>>
                </label>
            </div>
        </div>

        <br>

        <input type="submit" value="Split It Girl!" class='splitButton' name="submit">


        <br>

    </form>

    <?php if (!$initiateCalculation) : ?>
        <div class='standard'> Hi! I'm Katy Perry. You probably can't recognize me without my blue wig. When I'm not singing on tour, making music videos or brushing Nugget's cute curls, I split bills! It's definitely a fun hobby and a great way for me to practice my math skills. Make sure to fill in the above fields. If you don't want any change, just check the "Round Up" selection and I'll round your payment to the next whole dollar. Thanks!
        </div>

    <?php else : ?>
        <?php if ($form->hasErrors) : ?>
            <div class='alert alert-danger'>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php elseif (!$validCalculation) : ?>
            <div class='alert alert-danger'>
                Unable to make calculation as the split bill would be less than $0.01.
            </div>

        <?php else : ?>
            <div class="alert alert-success">
                <?= $printResults ?>
            </div>

        <?php endif; ?>
    <?php endif; ?>

</div>


</body>
</html>