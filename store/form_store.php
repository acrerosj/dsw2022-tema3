<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
<form action="create_store.php" method="post">
  <p>
    <label for="name">Nombre de la tienda:</label>
    <input type="text" name="name" id="name">
  </p>
  <p>
    <input type="submit" value="crear" name="create">
  </p>
</form>

<?php include('includes/footer.php'); ?>