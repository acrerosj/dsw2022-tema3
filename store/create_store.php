<?php include('includes/connection.php'); ?>
<?php
// Buscar el nombre en la base de datos
// Si está, indicar que ya existe y morir.
// si no insertar.

try {
  if (empty($_POST['name'])) throw new Exception('No hay nombre');
  $name = $_POST['name'];

  $sql = "INSERT INTO stores (id,name) VALUES(null, '$name')";
  $link->exec($sql);
} catch(PDOException $ex) {
  die("Error PDO al crear la tienda. " . $ex->getMessage());
} catch(Exception $ex) {
  die("Error genérico al crear la tienda. " . $ex->getMessage());
}
?>
<?php include("includes/disconnect.php"); ?>
<?php header('Location: store.php');?>