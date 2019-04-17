<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gissa mitt tal</title>
</head>
<body>
    <h1>Gissa mitt tal</h1>
    <form method="post">
        <input type="number" name="value" autofocus>
        <button type="submit" name="guess">Gissa</button>
        <button type="submit" name="restart">Börja om</button>
        <button type="submit" name="cheat">Fuska</button>
    </form>
    <p>
        <?= $result ?>
    </p>
    <p>
        <?= $triesLeft ?> gissningar kvar.
    </p>
    <p>
        <?= $cheat ?>
    </p>
</body>
</html>
