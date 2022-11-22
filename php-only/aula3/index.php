<?php
include "config.php";

if (isset($_POST['submit'])) {

    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];


    $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `gender`) VALUES ('$first_name','$last_name','$email','$password','$gender')";


    $result = $conn->query($sql);

    if ($result == TRUE) {
        echo "Dados do usuário gravados com sucesso.";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
    </head>

    <body>
        <div>
            <a href="list.php"><button type="button" style="float: right; margin-right: 9%" class="btn btn-primary">Ver usuários</button></a>
        </div>
        <h2><b><em>Inserir usuário</em></b></h2><hr> 

        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Primeiro nome</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Primeiro nome">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Apeido</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Apelido">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-6">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Masculino" checked>
                        <label class="form-check-label">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Femenino">
                        <label class="form-check-label">
                            Femenino
                        </label>
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>


        </form>

    </body>
</html>