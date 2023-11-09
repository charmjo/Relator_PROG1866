<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 10</title>
    <style>
        main {
            width: 250px;
            padding: 20px;
            border: 1px solid black;
            margin: 0 auto;
        }

        .field_wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <main>
        <form action="/Week_10/process.php" method="post">
            <div class="field_wrapper">
                <label for="uname">Name</label>
                <input type="text" name="uname" id="uname">
            </div>
                <div class="submit_wrapper">
                    <input type="submit" value="Submit">
                </div>

        </form>
    </main>
</body>
</html>