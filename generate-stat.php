<h1>Realizando las estadísticas</h1>
<?php
  /* Establecer la conexión */
  $conn = new mysqli('db', 'root', 'test', "world");

  /* comprobar la conexión */
  if ($conn->connect_errno) {
    printf("Falló la conexión: %s\n", $conn->connect_error);
    exit();
  }

  // Creamos la consulta preparada para saber el número de paises y el número de hablantes de cada idioma
  $stmtData = $conn->stmt_init();
  if (! $stmtData->prepare("SELECT count(*) as countries, round(sum(Population * Percentage/100)) as persons FROM countrylanguage, country "
    . "WHERE Language = ? AND CountryCode = Code;")) {
      echo "<h2>Error al preparar la consulta de paises y hablantes</h2>";
      echo "<p>" . $stmtData->error . "</p>";
      die();
  }
  $stmtData->bind_param("s", $language);
  $stmtData->bind_result($countries,$persons);

  // Preparamos la sentencia preparada para insertar los datos de cada idioma.
  $stmtInsert = $conn->stmt_init();
  if (! $stmtInsert->prepare("INSERT INTO languagestat (language, date, countries, persons) VALUES (?, ?, ?, ?)") ) {
    echo "<h2>Error al preparar la sentencia de insertar</h2>";
    echo "<p>" . $stmtInsert->error . "</p>";
    die();
  }
  $stmtInsert->bind_param("ssii", $language, $date, $countries, $persons);

  // Empezamos las transacciones
  $conn->autocommit(FALSE);

  // Borramos todos los datos de la tabla:
  $sql = "DELETE FROM languagestat";
  if ($conn->query($sql)) {
    echo "<h2>Datos eliminados</h2>";
  } else {
    $conn->rollback();
    die("Error al eliminar los datos: ");
  }

  // Buscamos todos los idiomas distintos que existen.
  $sql = "SELECT DISTINCT(language) FROM countrylanguage";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  // Para cada uno de ellos:
  while($row) {
    $language = $row['language'];
    $date = date("Y-m-d");
    // Ejecutamos la consulta preparada para conocer los países y hablantes.
    $stmtData->execute();
    // Actualiza las variables $countries y $persons.
    // Debemos almacenar los resultados porque tenemos dos sentencias preparadas.
    $stmtData->store_result();
    $stmtData->fetch();  // Esta consulta siempre genera una y solo una fila.
    echo "<p>$language - $date - $countries - $persons</p>";
    // Insertamos dichos valores en la tabla.
    if ($stmtInsert->execute()) {  // Si se ejecuta correctamente se indica
      echo "<p>Insertado</p>";
    } else {  // Si no se ejecuta correctamente se anula toda la transacción.
      $conn->rollback();
      die('Error: ' . $stmtInsert->error);
    }
  
    $row = $result->fetch_assoc();
  }

  // Liberamos los elementos.
  $result->free();
  $stmtData->close();
  $stmtInsert->close();
  $conn->commit();
  $conn->close();

?>
<h2>Generadas las estadísticas</h2>