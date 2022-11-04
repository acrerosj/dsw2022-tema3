ALGO
<?php
  setlocale(LC_ALL, "es_ES.UTF-8");
  $conn = mysqli_connect('db', 'root', 'test', "world");

  $stmt = $conn->prepare("INSERT INTO languagesta (language, date) VALUES (?,?)");
  $stmt->bind_param("ss", $language, $date);

  $sql = "SELECT DISTINCT(language) AS language FROM countrylanguage";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  while($row) {
    $language = $row['language'];
    $date = date("Y-m_d");
    $stmt->execute();
    $row = $result->fetch_assoc();
  }

  $result->close();
  $stmt->close();
  $conn->close();

?>
FIN