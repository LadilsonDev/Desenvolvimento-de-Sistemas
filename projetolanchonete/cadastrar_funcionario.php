<?php
include 'db.php';  // Inclui o arquivo de conexão ao banco de dados

// Recebe os dados do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

// Insere os dados no banco de dados
$sql = "INSERT INTO funcionarios (nome, cpf) VALUES ('$nome', '$cpf')";

if ($conn->query($sql) === TRUE) {
    echo "Funcionário cadastrado com sucesso";
} else {
    echo "Erro ao cadastrar funcionário: " . $conn->error;
}

$conn->close();  // Fecha a conexão com o banco de dados
?>
