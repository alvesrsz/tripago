<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include(__DIR__ . '/../../php/conexao.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido. Use GET.']);
    exit;
}

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Falha na conexão com o banco de dados.']);
    exit;
}

$sql = "SELECT * FROM hoteis";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar hotéis: ' . $conn->error]);
    exit;
}

$hoteis = [];

while ($row = $result->fetch_assoc()) {
    $hoteis[] = $row;
}

echo json_encode($hoteis);
?>
