<?php
 setlocale(LC_ALL, "es_ES.UTF-8");
 $conn = mysqli_connect('db', 'root', 'test', "world");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Language Statistics</title>
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
  <h1>Language Statistics</h1>
  <table>
    <thead>
      <tr>
        <th>Language</th>
        <th>Date</th>
        <th>Countries</th>
        <th>Persons</th>
      </tr>
    </thead>
    <tbody>
<?php
  $sql = "SELECT * FROM languagestat";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  while($row) {
    echo "<tr>";
    echo "<td>" . $row['language'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['countries'] . "</td>";
    echo "<td>" . $row['persons'] . "</td>";
    echo "</tr>";
    $row = $result->fetch_assoc();
  }
  $result->close();
?>
    </tbody>
  </table>
  <p>
    <a href="generate-stat.php">Generar estadística de idiomas</a>
  </p>
</body>
</html>
<?php
  $conn->close();
?>