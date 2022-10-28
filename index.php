<html>
    <head>
        <title>Welcome to LAMP Infrastructure</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <p><a href="form_create_person.html">Crear usuario</a></p>
            <?php
                echo "<h1>¡Hola, Antonio te da la bienvenida!</h1>";

                $conn = mysqli_connect('db', 'root', 'test', "dbname");

                $query = 'SELECT * From Person';
                //$result = mysqli_query($conn, $query);
                $result = $conn->query($query);

                echo '<table class="table table-striped">';
                echo '<thead><tr><th>id</th><th>name</th><th></th><th></th></tr></thead>';
                while($value = $result->fetch_array(MYSQLI_ASSOC)){
                    echo '<tr>';
                    $id = $value['id'];
                    $name = $value['name'];
                    foreach($value as $element){
                        echo '<td>' . $element . '</td>';
                    }
                    echo '<td><a href="form_update_person.php?id='.$id.'&name='.$name.'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                    echo '<td><a href="delete_person.php?id='.$id.'"><span class="glyphicon glyphicon-trash"></span></a></td>';
                    echo '</tr>';
                }
                echo '</table>';

                $result->close();
//                mysqli_close($conn);
                $conn->close();
            ?>
        </div>
    </body>
</html>
