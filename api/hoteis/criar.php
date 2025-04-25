<?php
header('Content-Type: application/json'); 
include_once(__DIR__ . '/../../php/conexao.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $nome = $_POST['nome'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $avaliacao = $_POST['avaliacao'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

   
    if (empty($nome) || empty($cidade)) {
        http_response_code(400);
        echo json_encode(["erro" => "Nome e cidade são obrigatórios."]);
        exit;
    }

    $sql = "INSERT INTO hoteis (nome, cidade, endereco, descricao, avaliacao, telefone, imagem)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssdss", $nome, $cidade, $endereco, $descricao, $avaliacao, $telefone, $imagem);

        if ($stmt->execute()) {
            echo json_encode(["mensagem" => "Hotel cadastrado com sucesso!", "id" => $stmt->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(["erro" => "Erro ao cadastrar: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["erro" => "Erro ao preparar a consulta: " . $conn->error]);
    }

    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido. Use POST."]);
}
