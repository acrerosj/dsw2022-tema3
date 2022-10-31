<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
</head>
<body>
<?php
 setlocale(LC_ALL, "es_ES.UTF-8");
 $conn = mysqli_connect('db', 'root', 'test', "tema3");
?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Activo</th>
      </tr>
    </thead>
    <tbody>
<?php
   $query = 'SELECT * From usuarios';
   $users = $conn->query($query);
   while ($user = $users->fetch_assoc()) {
    $date = date_create_from_format('Y-m-d', $user['fecha']); 
?>
  <tr>
    <td><?=$user['id']?></td>
    <td><?=$user['nombre']?></td>
    <td><?=strftime('%A, %d de %B de %Y', date_timestamp_get($date)); ?></td>
    <td><?=$user['activo']?></td>
  </tr>
<?php
  }
  $users->close();
  $conn->close();
?>
    </tbody>
  </table>
</body>
</html>