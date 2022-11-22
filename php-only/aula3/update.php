<?php
include "config.php";


if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $user_id = $_POST['user_id'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];


    $sql = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$password',`gender`='$gender' WHERE `id`='$user_id'";


    $result = $conn->query($sql);

    if ($result == TRUE) {
        echo "Dados do usuário actualizados com sucesso.";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];


    $sql = "SELECT * FROM `users` WHERE `id`='$user_id'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $first_name = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $gender = $row['gender'];
            $id = $row['id'];
        }
        ?>
        <!DOCTYPE html>
        <head>
            <title></title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        </head>
        <body>
            <div>
                <a href="list.php"><button type="button" style="float: right; margin-right: 9%; margin-top: 2%" class="btn btn-primary">Ver usuários</button></a>
            </div>
            <h2><b><em>Actualizar dados do usuário</em></b></h2><hr>


            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Primeiro nome</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Primeiro nome" value="<?php echo $first_name; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Apeido</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Apelido" value="<?php echo $lastname; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>">
                    </div>
                    <div class="form-group col-md-6">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Masculino" checked
                            <?php
                            if ($gender == 'Masculino') {
                                echo "checked";
                            }
                            ?> >
                            <label class="form-check-label">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Femenino" <?php
                            if ($gender == 'Femenino') {
                                echo "checked";
                            }
                            ?>>
                            <label class="form-check-label">
                                Femenino
                            </label>
                        </div>

                        <button type="submit" name="update" value="update" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>


            </form>

        </body>
        </html>




        <?php
    } else {

        header('Location: list.php');
    }
}
?>