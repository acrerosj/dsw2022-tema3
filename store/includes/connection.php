<?php
  $host = "db";
  $user = "root";
  $password = "test";
  $db = "storeDB";

  $dsn = "mysql:host=$host;dbname=$db";

  try {
    $link = new PDO($dsn, $user, $password);
    //$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $ex) {
    die("Error en la conexión. " . $ex->getMessage());
  }
?>