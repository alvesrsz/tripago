<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
include('../../php/conexao.php'); 

$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados) {
    echo json_encode(["success" => false, "mensagem" => "Nenhum dado recebido."]);
    exit;
}

$email = $dados['email'] ?? '';
$senha = $dados['senha'] ?? '';

$stmt = $conn->prepare("SELECT id, nome, senha, tipo FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

   if (password_verify($senha, $usuario['senha'])) {
    echo json_encode([
        "success" => true,
        "usuario_id" => $usuario['id'],
        "nome" => $usuario['nome'],
        "tipo" => $usuario['tipo'] 
    ]);
    } else {
        echo json_encode(["success" => false, "mensagem" => "Senha incorreta."]);
    }
} else {
    echo json_encode(["success" => false, "mensagem" => "E-mail não encontrado."]);
}

$stmt->close();
$conn->close();
