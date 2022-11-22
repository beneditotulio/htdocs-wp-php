<?php
$Nome = "Denylson";

$Teste2 = 5.5;
$Media = 13;
$Teste1 = (2*($Media)-$Teste2);
echo "<h1>1. a)<h1/>";
echo"O valor do primeiro teste do $Nome é: $Teste1 <br>";

$Nome = "Alberto";
$Teste1 = 16;
$Teste2 = 17.2;
$Media = ($Teste1+$Teste2)/2;
echo "<br> <h1>1. b)<h1/>";
echo"A média do $Nome é: $Media <br>";

if ($Media < 10) {
    echo "reprovado";
} else {
    echo "aprovado";
}


echo "<br>";
echo "<br> <h1>1. c)<h1/>";

$alunos = [
         [
             "aluno" => "Denylson",
             "teste1" => "0",
             "teste2" => "5.5",
             "Media" => "13",
             "Situacao" => "Aprovado"
         ],
         [
            "aluno" => "Alberto",
            "teste1" => "16",
            "teste2" => "17.2",
            "Media" => "0",
            "Situacao" => ""
        ],
        [
            "aluno" => "Túlio",
            "teste1" => "8",
            "teste2" => "0",
            "Media" => "9",
            "Situacao" => "Aprovado"
        ],
        [
            "aluno" => "Edy",
            "teste1" => "0",
            "teste2" => "0",
            "Media" => "0",
            "Situacao" => "Aprovado"
        ]
    
     ];
     
     foreach ($alunos as $aluno) {
             echo "Aluno: ".$aluno['aluno'];
             echo "<br>Teste1: ".$aluno['teste1'];
             echo "<br>Teste2: ".$aluno['teste2'];
             echo "<br>Media: ".$aluno['Media'];
             echo "<br>Situacao: ".$aluno['Situacao'];
             echo "<br>";
             echo "<br>";
         }


         echo "<br>";
         echo "<br>";

         echo "3. Tabuada<br>";

         $Numeros = [
             [
                 "Numero" => "1"
             ],
             [
                 "Numero"=> "2"
             ]
             ,
             [
                 "Numero"=> "3"
             ]
             ,
             [
                 "Numero"=> "4"
             ]
             ,
             [
                 "Numero"=> "5"
             ]
             ,
             [
                 "Numero"=> "6"
             ]
             ,
             [
                 "Numero"=> "7"
             ]
             ,
             [
                 "Numero"=> "8"
             ]
             ,
             [
                 "Numero"=> "9"
             ]
             ,
             [
                 "Numero"=> "10"
             ]
             ,
             [
                 "Numero"=> "11"
             ]
             ,
             [
                 "Numero"=> "12"
             ]

             ];

             foreach ($Numeros as $n) {
                 echo "<br>";
                 echo "Numero: ".$n['Numero'];
                 echo"<br>";

                 for ($i=1; $i <= 12; $i++) { 
                     echo $n['Numero'] ." x $i = " .$i*$n['Numero'] ."<br>";
                    }
             }
?>