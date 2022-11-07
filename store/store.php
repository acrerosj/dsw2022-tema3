<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>nombre</th>
      </tr>
    </thead>
    <tbody>
<?php
  $host = "db";
  $user = "root";
  $password = "test";
  $db = "storeDB";

  $dsn = "mysql:host=$host;dbname=$db";

  $link = new PDO($dsn, $user, $password);
?>
    </tbody>
  </table>
</body>
</html>