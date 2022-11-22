

<?php

include_once "./header.php";

define("GRADE", "7 Grade");

function verifyData($data = null) {
    if ( strlen($data['password']) < 10) {
        return false;
    }

    if ( strlen($data['username']) > 10) {
        return false;
    }

    return true;
 
}

if (isset($_POST['username']) && isset($_POST['password'])) {

    if (verifyData($_POST)) {
        echo "===================== Welcome to ".GRADE. date('d-m-Y') ." =========================<br>";
        echo "Name: ". $_POST['username'].'<br>';
        echo "Password: ". $_POST['password'];
    } 
    else {
        header("Location: index.php?error=Verifique os dados");
    }
    
}




?>



