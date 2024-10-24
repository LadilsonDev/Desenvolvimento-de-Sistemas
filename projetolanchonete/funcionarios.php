<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, cpf) VALUES (?, ?)");
    if ($stmt->execute([$nome, $cpf])) {
        echo json_encode(["status" => "success", "message" => "Funcionário cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao cadastrar funcionário."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM funcionarios");
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($funcionarios);
}
?>
