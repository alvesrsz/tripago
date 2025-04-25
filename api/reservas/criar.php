<?php
ob_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


file_put_contents("log_debug.txt", "🚀 Novo log iniciado\n");

include_once(__DIR__ . '/../../php/conexao.php');


$dados = json_decode(file_get_contents("php://input"), true);
file_put_contents("log_debug.txt", "📦 Dados recebidos:\n" . print_r($dados, true), FILE_APPEND);

if (
    isset($dados['usuario_id']) &&
    isset($dados['hotel_id']) &&
    isset($dados['data_entrada']) &&
    isset($dados['data_saida']) &&
    isset($dados['cpf']) &&
    isset($dados['telefone']) &&
    isset($dados['metodo_pagamento']) &&
    isset($dados['salvar_dados'])
) {
    $usuario_id = (int)$dados['usuario_id'];
    $hotel_id = (int)$dados['hotel_id'];
    $data_entrada = $dados['data_entrada'];
    $data_saida = $dados['data_saida'];
    $cpf = $dados['cpf'];
    $telefone = $dados['telefone'];
    $metodo_pagamento = $dados['metodo_pagamento'];
    $salvar_dados = (int)$dados['salvar_dados'];

    file_put_contents("log_debug.txt", "✅ Antes do prepare()\n", FILE_APPEND);

    $stmt = $conn->prepare("INSERT INTO reservas (usuario_id, hotel_id, data_entrada, data_saida, cpf, telefone, metodo_pagamento, salvar_dados) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        file_put_contents("log_debug.txt", "❌ Erro no prepare(): " . $conn->error . "\n", FILE_APPEND);
        echo json_encode(["error" => "Erro no prepare()", "detalhes" => $conn->error]);
        exit;
    }

    file_put_contents("log_debug.txt", "✅ Antes do bind_param()\n", FILE_APPEND);

    if (!$stmt->bind_param("iisssssi", $usuario_id, $hotel_id, $data_entrada, $data_saida, $cpf, $telefone, $metodo_pagamento, $salvar_dados)) {
        file_put_contents("log_debug.txt", "❌ Erro no bind_param(): " . $stmt->error . "\n", FILE_APPEND);
        echo json_encode(["error" => "Erro no bind_param()"]);
        exit;
    }

    file_put_contents("log_debug.txt", "✅ Antes do execute()\n", FILE_APPEND);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["success" => true]);
    } else {
        $erro = $stmt->error;
        file_put_contents("log_debug.txt", "❌ Erro no execute(): " . $erro . PHP_EOL, FILE_APPEND);
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode([
            "success" => false,
            "mensagem" => "Erro ao salvar no banco.",
            "erro_sql" => $erro
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    file_put_contents("log_debug.txt", "❌ Dados incompletos\n", FILE_APPEND);
    echo json_encode(["error" => "Dados incompletos", "dados_recebidos" => $dados]);
}

ob_end_flush();
