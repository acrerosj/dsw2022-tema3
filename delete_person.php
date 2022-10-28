<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Person</title>
</head>
<body>
<?php 
  if (empty($_GET['id'])) {
    echo "<h2>No hay id</h2>";
  } else {
    $id = $_GET['id'];
    echo "<h1>Delete person: $id</h1>";
    $conn = mysqli_connect('db', 'root', 'test', "dbname");
    $sql = "DELETE FROM Person WHERE id=" . $id;
    $result = $conn->query($sql);
    if ($result) {
      echo "<p>Se ha eliminado satisfactorimente.</p>";
    } else {
      echo "<p>Error al eliminar:</p>";
      echo "<pre>$sql</pre>";
    }
  }
?>  
<p><a href="index.php">Mostrar listado de personas</a></p>
</body>
</html>