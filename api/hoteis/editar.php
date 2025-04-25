<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . '/../../php/conexao.php');

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    $avaliacao = $_POST['avaliacao'];
    $telefone = $_POST['telefone'];
    $imagem = $_POST['imagem'];
    $link = $_POST['site'] ?? '';


    $sql = "UPDATE hoteis SET 
        nome = ?, 
        cidade = ?, 
        endereco = ?, 
        descricao = ?, 
        avaliacao = ?, 
        telefone = ?, 
        site = ?, 
        imagem = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssssi", 
            $nome, $cidade, $endereco, $descricao, 
            $avaliacao, $telefone, $link, $imagem, $id);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Hotel atualizado com sucesso."]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao preparar statement: " . $conn->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido. Use PUT."]);
}
