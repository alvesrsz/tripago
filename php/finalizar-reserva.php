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
    $nova_data_saida = date('Y-m-d');

    $sql = "UPDATE reservas SET data_saida = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nova_data_saida, $reserva_id, $usuario_id);

    if ($stmt->execute()) {
        echo "Reserva finalizada com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao finalizar reserva.";
    }
} else {
    http_response_code(400);
    echo "Requisição inválida.";
}
?>
