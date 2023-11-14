<?php
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
?>

<div class="error-messages">
    <ol>
        <?php foreach ($errors as $error) { ?>
        <li> <?php echo $error; ?> </li>
        <?php } ?>
    </ol>
</div>