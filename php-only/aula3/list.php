<?php
include "config.php";

$sql = "SELECT * FROM users";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Page</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
         <div>
            <a href="index.php"><button type="button" style="float: right; margin-right: 15%; margin-top: 2%" class="btn btn-primary">Novo usuário</button></a>
        </div>
        <div class="container">
           
            <h2><b><em>Lista dos usuários</em></b></h2><hr>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Primeiro nome</th>
                        <th scope="col">Apelido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>	
<?php
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
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