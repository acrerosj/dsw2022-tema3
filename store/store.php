<?php include("includes/connection.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
<h1>Tiendas</h1>
  <table>
    <thead>
      <tr>
        <th>id</th>
        <th>nombre</th>
      </tr>
    </thead>
    <tbody>
<?php


  $sql = "SELECT * FROM stores";
  $result = $link->query($sql);

  // while ($row = $result->fetch()) {
  //   printf("<tr><td>%s</td><td>%s</td></tr>",$row['id'],$row['name']);
  // }

  while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    printf("<tr><td>%s</td><td>%s</td></tr>",$row->id,$row->name);
  }
?>
    </tbody>
  </table>
<?php include('includes/footer.php'); ?>
<?php include("includes/disconnect.php"); ?>