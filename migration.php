<?php
$conn = mysqli_connect('db', 'root', 'test', "world");

$origin = $_POST['origin'];
$destination = $_POST['destination'];
$number = $_POST['number'];

// Transacción
$conn->autocommit(FALSE);

$sql = "UPDATE country SET Population = Population + $number WHERE Code = '$destination'";
if ($conn->query($sql)) {
  echo "<p>$number añadidos a destino.</p>";
} else {
  echo "<p>Error al añadir a destino.</p>";
  $conn->rollback();
  exit();
}

$sql = "UPDATE country SET Population = Population - $number WHERE Code = '$origin'";
if ($conn->query($sql)) {
  echo "<p>$number eliminados a origen.</p>";
} else {
  echo "<p>Error al eliminados de origen.</p>";
  $conn->rollback();
  exit();
}

$sql = "SELECT Population FROM country WHERE Code = '$origin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$population_origin = $row['Population'];
if ($population_origin<0) {
  $conn->rollback();
  echo "<h1> No puedes desplazar tanta gente</h1>";
  exit();
}


// Confirmar la transacción
if ($conn->commit()) {
  echo "<p>Desplazamiento realizado</p>";
} else {
  echo "<p>No se ha hecho la transacción</p>";
}


$conn->close();