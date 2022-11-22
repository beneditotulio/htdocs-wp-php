<?php
include "config.php";


//RECEIVING DATA FROM THE FORM CURRENT FORM
if (isset($_POST['update'])) {

    $author = $_POST['author'];
    $title = $_POST['title'];
    $yearpub = $_POST['yearpub'];
    $publisher = $_POST['publisher'];
    $bookId = $_POST['bookId'];
    

    $sql = "UPDATE `BOOKS` SET `author`='$author',`title`='$title',`yearpub`='$yearpub',`publisher`='$publisher' WHERE `id`='$bookId'";


    $result = $conn->query($sql);

    if ($result == TRUE) {
        echo "Dados do usuário actualizados com sucesso.";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

//GETTING DATA FROM LIST PAGE
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];


    $sql = "SELECT * FROM `BOOKS` WHERE `id`='$bookId'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $author = $row['AUTHOR'];
            $title =  $row['TITLE'];
            $yearpub = $row['YEARPUB'];
            $publisher = $row['PUBLISHER'];
            $id = $row['ID'];
        }
        ?>

        <!DOCTYPE html>
        <head>
            <title></title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        </head>
        <body>
            <div>
                <a href="list.php"><button type="button" style="float: right; margin-right: 9%; margin-top: 2%" class="btn btn-primary">Ver livros</button></a>
            </div>
            <h2><b><em>Actualizar livros</em></b></h2><hr>


            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="author">Autor</label>
                        <input type="text" class="form-control" name="author" placeholder="Nome do autor" value="<?php echo $author; ?>">
                        <input type="hidden" name="bookId" value="<?php echo $id; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title">Titulo</label>
                        <input type="text" class="form-control" name="title" placeholder="Titulo" value="<?php echo $title; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="yearpub">Ano de publicacao</label>
                        <input type="date" class="form-control" name="yearpub"  value="<?php echo $yearpub; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="publisher">Editora</label>
                        <input type="text" class="form-control" name="publisher" placeholder="Editora" value="<?php echo $publisher; ?>">
                    </div>
                    <div class="form-group col-md-6">
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