<?php

/*
$_POST['city'] = isset($_POST['city']) ? $_POST['city'] : null;

# Caso o valor de $_POST seja verdadeiro (diferente de "" ou null)
# executaremso o bloco if
if ($_POST['city']) {
    echo "armazenar '{$_POST['city']}'";
} else {
    echo "não armazenar nada!";
}*/

$city = $_POST['city'];
if (isset($_POST['city'])) 
{
    if(($city != null))
    {
        echo "<br>";
        echo "A cidade selecionada é: ".$city." pertence";

        switch($city)
        {
            case 1:
            case 2:
            case 3:
            echo " a Zona Sul";
            break;
           
            case 4:
            case 5:
            case 6:
            case 7:
            echo " a Zona Centro";
            break;

            case 8:
            case 9:
            case 10:
                echo " a Zona Norte";
                break;
        }
    }
    else
    {
    echo "Por favor selecione uma provincia";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    
    </head>

    <body>
        <div>
            <a href="index.php"><button type="button" style="float: right; margin-right: 9%" class="btn btn-primary">Voltar</button></a>
        </div>
        <h2 class = "text-center"><b><em>Exercicio 2</em></b></h2><hr> 
        <pre>
        4. Use a estrutura condicional SWITCH e crie um programa que mostre uma lista com as províncias de
        Moçambique e que permita que o usuário selecione uma província e o programa diga se pertence a região
        Norte, Centro ou Sul do país.
        </pre>
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <div class="form-check">
                <select name="city">
                 <option value=""></option>
                 <option value="1">Maputo</option>
                 <option value="2">Gaza</option>
                 <option value="3">Inhambane</option>
                 <option value="4">Sofala</option>
                 <option value="5">Manica</option>
                 <option value="6">Tete</option>
                 <option value="7">Zambezia</option>
                 <option value="8">Nampula</option>
                 <option value="9">Niassa</option>
                 <option value="10">Cabo-Delgado</option>
                </select>
                </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submeter</button>
                </div>
            </div>
        </form>
    </body>
</html>
