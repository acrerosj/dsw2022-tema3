<?php 
  @$link = new mysqli('db', 'root', 'test', 'world');
  $error = $link->connect_errno;
  if ($error != null) {
    echo "<p>El error número: $error</p>";
    echo "<p>El error dice: $link->connect_error </p>";
    die(); // Parar la ejecución;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select City</title>
</head>
<body>
  <h1>Buscar Ciudad</h1>
<?php
  if (empty($_GET['continent']) && empty($_GET['countryCode']) && empty($_GET['cityID'])) {
    // Se muestra el formulario del continente pero no se muestra ninguno más.
?>
    <form action="select_city.php" method="get">
      <p>
        <select name="continent">
          <option selected disabled>Elige un continente</option>
<?php
  $sql = "SELECT DISTINCT(Continent) FROM country";
  $continents = $link->query($sql);
  while ( ( $continent = $continents->fetch_assoc() ) !== null) {
    printf("\t\t\t<option value=\"%s\">%s</option>\n",$continent['Continent'],$continent['Continent']);
  }
  $continents->close();
?>
        </select>
        <input type="submit" value="Buscar">
      </p>
    </form>
<?php
  } else {
    if (empty($_GET['countryCode']) && empty($_GET['cityID'])) {
          // Ya hay un continente.
      $continent = $_GET['continent'];
      printf("<h2>%s</h2>",$continent);
      // Se muestra el formulario del país.
    ?>
        <form action="select_city.php" method="get">
          <p>
            <select name="countryCode">
              <option selected disabled>Elige un país</option>
    <?php
      $sql = "SELECT Code, Name FROM country WHERE Continent='$continent'";
      $countries = $link->query($sql);
      while ( ( $country = $countries->fetch_assoc() ) !== null) {
        printf("\t\t\t<option value=\"%s\">%s</option>\n",$country['Code'],$country['Name']);
      }
      $countries->close();
    ?>
            </select>
            <input type="submit" value="Buscar">
          </p>
        </form>
    <?php
      } else {
        if (empty($_GET['cityID'])) {
        // Ya hay un país
        $countryCode = $_GET['countryCode'];
        printf("<h2>%s</h2>",$countryCode);
              // Se muestra el formulario de las ciudades
    ?>
        <form action="select_city.php" method="get">
          <p>
            <select name="cityID">
              <option selected disabled>Elige una ciudad</option>
    <?php
      $sql = "SELECT ID, Name FROM city WHERE CountryCode='$countryCode'";
      $cities = $link->query($sql);
      while ( ( $city = $cities->fetch_assoc() ) !== null) {
        printf("\t\t\t<option value=\"%s\">%s</option>\n",$city['ID'],$city['Name']);
      }
      $cities->close();
    ?>
            </select>
            <input type="submit" value="Buscar">
          </p>
        </form>
    <?php
      } else {
        // Ya hay una ciudad
        $cityID = $_GET['cityID'];
        // Busco los datos de la ciudad:
        $sql = "SELECT city.Name AS city, country.Name AS country, country.Continent AS continent FROM city, country WHERE ID='$cityID' AND CountryCode = Code";
        $cities = $link->query($sql);
        $city = $cities->fetch_assoc();
        if ($city == null) {
          echo "<h3>Ciudad no encontrada</h3>";          
        } else {
          printf("<h2>Ciudad: %s</h2>",$city['city']);
          printf("<h2>País: %s</h2>",$city['country']);
          printf("<h2>Continente: %s</h2>",$city['continent']);
        }
        $cities->close();

      } 
    }    
  }
  $link->close();
?>
</body>
</html>