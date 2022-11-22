<?php
if (isset($_POST['submit'])) {
    $firstNumber = $_POST['firstNumber'];
    $secondNumber = $_POST['secondNumber'];
    if(($firstNumber != null) | ($secondNumber != null))
    {
 
    $soma= $firstNumber+$secondNumber;
    $diferenca = max($firstNumber, $secondNumber) - min($firstNumber, $secondNumber);
    $divisao = max($firstNumber, $secondNumber) / min($firstNumber, $secondNumber);
    $modulo = max($firstNumber, $secondNumber) % min($firstNumber, $secondNumber);
    $media = $soma/2;

    //Variável para receber o código da tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>Descrição do exercício</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>';
  
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    
    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Valores recebidos</td>';
    $tabela .= '<td>'.$firstNumber.",".$secondNumber.'</td>'; 
    $tabela .= '</tr>'; // fecha linha


    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Soma dos valores</td>'; 
    $tabela .= '<td>'.$firstNumber."+".$secondNumber."=".$soma.'</td>'; //coluna numero
    $tabela .= '</tr>'; // fecha linha
    /*loop*/

    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Subtração dos valores</td>'; 
    $tabela .= '<td>'.max($firstNumber, $secondNumber)."-".min($firstNumber, $secondNumber)."=".$diferenca.'</td>'; //coluna numero
    $tabela .= '</tr>'; // fecha linha

    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Divisão</td>';
    $tabela .= '<td>'.max($firstNumber, $secondNumber)."/".min($firstNumber, $secondNumber)."=".$divisao.'</td>'; //coluna numero
    $tabela .= '</tr>'; // fecha linha

    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Modulo dos valores</td>'; 
    $tabela .= '<td>'.max($firstNumber, $secondNumber)."%".min($firstNumber, $secondNumber)."=".$modulo.'</td>'; //coluna numero
    $tabela .= '</tr>'; // fecha linha

    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>Média dos valores</td>'; 
    $tabela .= '<td>'."(".$firstNumber."+".$secondNumber.")"."/"."2"."=".$media.'</td>'; //coluna numero
    $tabela .= '</tr>'; // fecha linha
    /*loop*/
    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela

    echo $tabela; // imprime
}
else
{
    echo "Por favor preencha os campos";
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
        <h2 class= "text-center"><b><em>Exercicio 1</em></b></h2><hr>
        <pre>
         1. Use operadores aritméticos e crie um programa que receba 2 (dois) números inteiros e faça em
         simultâneo as seguintes operações:
         a) Imprima na tela os valores recebidos
         b) Imprima na tela a soma dos valores
         c) Imprima na tela a subtração dos valores
         d) Imprima na tela a divisão
         e) Imprima na tela o modulo dos valores
         f) Imprima na tela a media dos valores
        </pre>

        <form action="" method="POST">
        <fieldset>
        <legend>Exercicios</legend>
        
            <div class="form-row">
                <div class="form-group col-md-6">
                <div class="form-check">
                    <label for="firstNumber">Primeiro Número</label>
                    <input type="number" class="form-control" name="firstNumber" placeholder="Primeiro número">
                </div>
                <div class=form-check>
                    <label for="secondNumber">Segundo Número</label>
                    <input type="number" class="form-control" name="secondNumber" placeholder="Segundo Número">
                </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submeter</button>
                </div>
            </div>
            </fieldset>
        </form>

    </body>
</html>
