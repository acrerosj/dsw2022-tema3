<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
  if (empty($_POST['id']) || empty($_POST['name'])) {
    echo "<h2>No se puede crear usuario sin id o nombre.</h2>";
  } else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $conn = mysqli_connect('db', 'root', 'test', "dbname");
    $sql = "INSERT INTO Person (id, name) VALUES ($id, '$name')";
    $result = $conn->query($sql);
    if ($result) {
      echo "<p>Se ha creado satisfactorimente.</p>";
    } else {
      echo "<p>Error al crear:</p>";
      echo "<pre>$sql</pre>";
    }
  }
?>
<p><a href="index.php">Mostrar listado de personas</a></p>
</body>
</html>