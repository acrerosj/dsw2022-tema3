<?php
 setlocale(LC_ALL, "es_ES.UTF-8");
 $conn = mysqli_connect('db', 'root', 'test', "tema3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <style>
    .alert { color: red; }
    .success { color: darkgreen; }
    table {
      border-collapse: collapse;
      margin: 0px auto;
    }
    th, td {
      text-align: center;
      padding: 3px 10px;
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <h1>USUARIOS</h1>
<?php
  $nameError = "";
  $dateError = "";
  if (isset($_POST['create'])) {
    if (empty($_POST['name'])) $nameError="Falta indicar el nombre";
    if (empty($_POST['date'])) $dateError="Falta indicar la fecha";
    if (strlen($nameError)>0 || strlen($dateError)>0) {
      echo '<h3 class="alert">No se puede crear el usuario</h3>';
    } else {
      $name = $_POST['name'];
      $date = $_POST['date'];
      $active = isset($_POST['active']) ? 1 : 0;
      $sql = "INSERT INTO usuarios (id, nombre, fecha, activo) VALUES (null,'$name','$date',$active)";
      $result = $conn->query($sql);
      if ($result) {
        echo '<h3 class="success">Usuario creado correctamente</h3>';
      } else {
        echo '<h3 class="alert">Error en la consulta</h3>';
        echo "<pre>$sql</pre>";
      }
    }
  }
?>
  <h2>Listado de usuarios</h2>

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
    $active = $user['activo'] == 1 ? "Si" : "No";
?>
  <tr>
    <td><?=$user['id']?></td>
    <td><?=$user['nombre']?></td>
    <td><?=strftime('%A, %d de %B de %Y', date_timestamp_get($date)); ?></td>
    <td><?=$active?></td>
  </tr>
<?php
  }
  $users->close();
  $conn->close();
?>
    </tbody>
  </table>
  <h2>Insertar nuevo Usuario</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p>
      <label for="name">Nombre: </label>
      <input type="text" name="name" id="name"> <span class="alert"><?=$nameError?></span>
    </p>
    <p>
      <label for="date">Fecha:</label>
      <input type="date" name="date" id="date" value="<?=date('Y-m-d')?>"> <span class="alert"><?=$dateError?></span>
    </p>
    <p>
      <input type="checkbox" name="active" id="active">
      <label for="active"> Activo</label>
    </p>
    <p>
      <input type="submit" value="Crear" name="create">
    </p>
  </form>
  
</body>
</html>