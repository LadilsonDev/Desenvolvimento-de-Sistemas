<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_pedido = $_POST['nome_pedido'];
    $descricao = $_POST['descricao'];
    $responsavel_id = $_POST['responsavel_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO pedidos (nome_pedido, descricao, responsavel_id, status) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nome_pedido, $descricao, $responsavel_id, $status])) {
        echo json_encode(["status" => "success", "message" => "Pedido cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao cadastrar pedido."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT p.*, f.nome AS responsavel FROM pedidos p LEFT JOIN funcionarios f ON p.responsavel_id = f.id");
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($pedidos);
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $status = $_PUT['status'];

    $stmt = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
    if ($stmt->execute([$status, $id])) {
        echo json_encode(["status" => "success", "message" => "Status atualizado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao atualizar status."]);
    }
}
?>
