<?php
include 'db.php';  // Inclui o arquivo de conexão ao banco de dados

// Recebe os dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$responsavel = $_POST['responsavel'];
$status = $_POST['status'];

// Insere os dados no banco de dados
$sql = "INSERT INTO pedidos (nome, descricao, responsavel, status) 
VALUES ('$nome', '$descricao', '$responsavel', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Pedido cadastrado com sucesso";
} else {
    echo "Erro ao cadastrar pedido: " . $conn->error;
}

$conn->close();  // Fecha a conexão com o banco de dados
?>
