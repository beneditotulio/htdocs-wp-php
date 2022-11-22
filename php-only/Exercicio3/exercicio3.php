<?php

if (isset($_POST['submit'])) {
    $firstNumber = $_POST['firstNumber'];
    $secondNumber = $_POST['secondNumber'];
    if(($firstNumber != null) | ($secondNumber != null))
    {
     $bill = $secondNumber - $firstNumber;
     $payment = 40*$bill;
     if($bill < 20 )
     {
        echo "<br>";
        echo "O consumo é: ".$bill."m3";
        echo "<br> A leitura anterior é: ".$firstNumber;
        echo "<br> A leitura actual é: ".$secondNumber;
        echo "<br> O valor a pagar é: ".$payment;
        echo "<br> Esta é uma factura de consumo Domestico";
     }
     else if($bill > 20 )
     {
        echo "<br>";
        echo "O consumo é: ".$bill."m3";
        echo "<br> A leitura anterior é: ".$firstNumber;
        echo "<br> A leitura actual é: ".$secondNumber;
        echo "<br> O valor a pagar é: ".$payment;
        echo "<br> Esta é uma factura de consumo Industrial";
     }
      
      
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
        3. Use a estrutura condicional IF e ELSEIF e crie um programa que distinga se o consumidor é Domestico
        ou Industrial e calcule o consumo de água e o valor a pagar.
        </pre>
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <div class="form-check">
                    <label for="firstNumber">Qual é a leitura anterior?</label>
                    <input type="number" class="form-control" name="firstNumber" placeholder="Leitura anterior">
                </div>
                <div class="form-check">
                    <label for="secondNumber">Qual é a leitura actual?</label>
                    <input type="number" class="form-control" name="secondNumber" placeholder="Leitura actual">
                </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submeter</button>
                </div>
            </div>
        </form>
    </body>
</html>
