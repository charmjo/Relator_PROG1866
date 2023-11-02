<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td {
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .align-right {
            text-align: right;
        }

        td:nth-child(2){
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
        include("includes/nav.php");
    ?>
    <main>
        <?php
            $a= 50;
            $b = 90;
            $sum = $a + $b;
        ?>
        <table>
            <tr>
                <td>a</td>
                <td><?php echo $a; ?></td>                
            </tr>
            <tr>
                <td>b</td>
                <td><?php echo $b; ?></td>                
            </tr>
            <tr>
                <td>Sum</td>
                <td><?php echo $sum; ?></td>                
            </tr>                   
        </table>
    </main>
</body>
</html>