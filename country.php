<?php 
  @$link = new mysqli('db', 'root', 'test', 'world');
  $error = $link->connect_errno;
  if ($error != null) {
    echo "<p>El error número: $error</p>";
    echo "<p>El error dice: $link->connect_error </p>";
    die(); // Parar la ejecución;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Country</title>
</head>
<body>
<?php
  $code = $_GET['code'];
  $sql = "SELECT Code, Name, Continent FROM country WHERE Code='$code'";
  $result = $link->query($sql);
  $country = $result->fetch_assoc();
  if ($country == null) {
    echo "<h1>Código no encontrado</h1>";
  } else {
    printf("<h1>Bienvenidos a %s</h1>", $country['Name']);
    printf("<h2>con código %s, situado en %s",$country['Code'], $country['Continent']);
  }
?>
</body>
</html>
<?php
  $link->close();
?>