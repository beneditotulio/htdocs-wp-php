 <?php
$servername = "localhost";
$username = "root"; // default username for localhost is root
$password = ""; // default password for localhost is empty
$dbname = "aula3"; // nome da base de dados

// Cria a conexao
$conn = new mysqli($servername, $username, $password, $dbname);
// vrifica a conexao
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?> 