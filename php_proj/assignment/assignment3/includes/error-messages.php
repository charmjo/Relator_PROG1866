<div class="error-messages">
    <ol class="line-spacing">
        <?php
            foreach ($errors as $error) { 
        ?>
        <li class="padding-20-all"><?php echo $error;?> </li>
        <?php
            } 
        ?>
    </ol>
</div>