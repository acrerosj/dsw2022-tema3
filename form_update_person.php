<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Persona</title>
</head>
<body>
  <h1>Modificar persona</h1>
  <?php
    if (empty($_GET['id'])) {
      echo "<h1>No hay id de usuario</h1>";
    } else {
      $id = $_GET['id'];
      $name = $_GET['name'];
      echo "ID: $id";
?>
  <form action="update_person.php" method="post">
    <p>
      <input type="hidden" name="id" value="<?=$id?>" readonly>
      <input type="text" name="name" value="<?=$name?>"
        placeholder="Nombre de la persona a modificar">
      <input type="submit" value="modificar">
    </p>
  </form>
<?php 
    }
?>
</body>
</html>