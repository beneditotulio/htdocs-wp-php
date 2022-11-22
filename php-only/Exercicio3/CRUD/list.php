<?php
include "config.php";

$sql = "SELECT * FROM `BOOKS`";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Page</title>
        <link rel="stylesheet" href="./bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
         <div>
            <a href="index.php"><button type="button" style="float: right; margin-right: 15%; margin-top: 2%" class="btn btn-primary">Novo Livro</button></a>
        </div>
        <div class="container">
           
            <h2><b><em>Lista de livros</em></b></h2><hr>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Accao</th>
                    </tr>
                </thead>
                <tbody>	
<?php
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        ?>

                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['AUTHOR']; ?></td>
                                <td><?php echo $row['TITLE']; ?></td>
                                <td><?php echo $row['YEARPUB']; ?></td>
                                <td><?php echo $row['PUBLISHER']; ?></td>
                                <td><a class="btn btn-info" href="update.php?id=<?php echo $row['ID']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['ID']; ?>">Delete</a></td>
                            </tr>	

    <?php
    }
}
?>

                </tbody>
            </table>
        </div>

    </body>
</html>