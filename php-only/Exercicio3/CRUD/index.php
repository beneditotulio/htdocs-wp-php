<?php
include "config.php";

if (isset($_POST['submit'])) {

    $author = $_POST['author'];
    $title = $_POST['title'];
    $yearpub = $_POST['yearpub'];
    $publisher = $_POST['publisher'];

    $sql = "INSERT INTO `BOOKS`(`AUTHOR`, `TITLE`, `YEARPUB`, `PUBLISHER`) VALUES ('$author','$title','$yearpub','$publisher')";


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
        <link rel="stylesheet" href="./bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">
        <script type ="text/javascript" scr = "./bootstrap-5.0.0-beta3-dist/css/bootstrap.min.js"></script>
    </head>

    <body>
        <div>
            <a href="list.php"><button type="button" style="float: right; margin-right: 9%" class="btn btn-primary">Ver livros</button></a>
        </div>
        <h2 class = "text-center"><b><em>Cadastro de Livros</em></b></h2><hr> 

        <form action="" method="POST">
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="author">Autor</label>
                    <input type="text" class="form-control" name="author" placeholder="Nome do autor">
                </div>
                <div class="form-group col-md-6">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" name="title" placeholder="Titulo do livro">
                </div>
                <div class="form-group col-md-6">
                    <label for="yearpub">Ano de publicação</label>
                    <input type="date" class="form-control" name="yearpub" >
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Editora</label>
                    <input type="text" class="form-control" name="publisher" placeholder="Editora">
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>

            </div>
        </form>

    </body>
</html>