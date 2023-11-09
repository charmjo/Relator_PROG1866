<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
    <?php
    // fetch data
    $uname = $_POST['uname'];

    $errors = "";
    if(!$uname) {
        $errors .="please enter name <br>";
    }

    // validate
    if($errors){
        echo $erros;
        return;
    }

    //show output
    echo "Thanks for submitting the form $uname";
    ?>
    </main>
</body>
</html>
