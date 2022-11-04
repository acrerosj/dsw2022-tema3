<?php
$link = new mysqli('db', 'root', 'test', 'world');

if (isset($_POST['change'])) {
    $oldCode = isset($_POST['oldcode']) ? $_POST['oldcode'] : '';
    $newCode = isset($_POST['newcode']) ? $_POST['newcode'] : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Code</title>
</head>
<body>
    <h1>Cambiar código de país</h1>
    <form action="<?=$_SESSION['SELF']?>" method="post">
        <p>
            <label for="oldcode">Código original</label>
            <input type="text" name="oldcode" id="oldcode">
        </p>
        <p>
            <label for="newcode">Código nuevo</label>
            <input type="text" name="newcode" id="newcode">
        </p>
        <p>
            <input type="submit" value="change" name="change">
        </p>
    </form>
</body>
</html>