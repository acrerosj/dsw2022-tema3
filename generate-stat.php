<h1>Realizando las estadísticas</h1>
<?php
  $conn = mysqli_connect('db', 'root', 'test', "world");

  $stmt = $conn->prepare("INSERT INTO languagestat (language, date) VALUES (?,?)");
  $stmt->bind_param("ss", $language, $date);

  $sql = "SELECT DISTINCT(language) FROM countrylanguage";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  while($row) {
    $language = $row['language'];
    echo "<p>$language</p>";
    $date = date("Y-m-d");
    $stmt->execute();
    $row = $result->fetch_assoc();
  }

  $result->close();
  $stmt->close();
  $conn->close();

?>
<h2>Generadas las estadísticas</h2>