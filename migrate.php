<?php
 setlocale(LC_ALL, "es_ES.UTF-8");
 $conn = mysqli_connect('db', 'root', 'test', "world");

 function optionCountries($conn) {
  $sql = "SELECT Code, Name FROM country";
  $result = $conn->query($sql);
  while($country = $result->fetch_assoc()) {
    printf("<option value='%s'>%s</option>\n", $country['Code'],$country['Name']);
  }
  $result->close();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Migración</h1>
  <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <p>
      <label for="origin">Origen: </label>
      <select name="origin" id="origin">
        <option selected disabled>Elige un país</option>
        <?php optionCountries($conn); ?>
      </select>
    </p>
    <p>
      <label for="destination">Destino: </label>
      <select name="destination" id="destination">
        <option selected disabled>Elige un país</option>
        <?php optionCountries($conn); ?>
      </select>
    </p>
    <p>
      <label for="number">Desplazados</label>
      <input type="number" name="number" id="number">
    </p>
    <p>
      <input type="submit" value="Desplazar" name="migrate">
    </p>
  </form>
</body>
</html>
<?php $conn->close(); ?>