 <?php
$servername = "localhost";
$username = "root"; // default username for localhost is root
$password = ""; // default password for localhost is empty
$dbname = "exercicio3db"; // nome da base de dados

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// verify connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?> 