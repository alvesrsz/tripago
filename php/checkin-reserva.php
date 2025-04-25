<?php
session_start();
header('Content-Type: text/plain'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserva_id'])) {
    include 'conexao.php';

    if (!isset($_SESSION['id'])) {
        http_response_code(401);
        echo "Usuário não autenticado.";
        exit;
    }

    $reserva_id = intval($_POST['reserva_id']);
    $usuario_id = $_SESSION['id'];
    $nova_data_entrada = date('Y-m-d');

    $sql = "UPDATE reservas SET data_entrada = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nova_data_entrada, $reserva_id, $usuario_id);

    if ($stmt->execute()) {
        echo "Check-in realizado com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao realizar check-in.";
    }
} else {
    http_response_code(400);
    echo "Requisição inválida.";
}
?>
