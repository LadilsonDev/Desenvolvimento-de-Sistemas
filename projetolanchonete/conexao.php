<?php
$servername = 'localhost';  
$username = 'root';  
$password = '';  
$dbname = 'Proejto_Lanchonete';  

// criar conexáo
$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

// verificar conexao
if ($conn->connect_error) {
    die("Falha na conexão - >" . $conn->connect_error);

}
?>
