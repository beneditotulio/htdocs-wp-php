<?php

if (isset($_POST['submit'])) {
    $price = $_POST['price'];
   

    if(($price != null))
    {
        $a = $price*1.25;
        $b = $price-($price*0.25);

     
      echo "<br>";
      echo "O valor introduzido é:".$price;
      echo "<br>a) O preço com aumento de 25% é: ".$a;
      echo "<br>b) O preço com desconto de 25% é: ".$b;
    }
    else
    {
    echo "Por favor preencha o campo";
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
        2. Use operadores de atributo e crie um programa que receba o preço de um produto e imprima na tela:
        a) O preço com aumento de 25%
        b) O preço com desconto de 25%
        </pre>
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <div class="form-check">
                    <label for="price">Qual é o preço do produto?</label>
                    <input type="number" class="form-control" name="price" placeholder="Primeiro número">
                </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submeter</button>
                </div>
            </div>
        </form>
    </body>
</html>
