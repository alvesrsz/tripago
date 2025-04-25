<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserva_id'])) {
    include 'conexao.php';

    $reserva_id = intval($_POST['reserva_id']);
    $usuario_id = $_SESSION['id'];

    $sql = "DELETE FROM reservas WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $reserva_id, $usuario_id);

    if ($stmt->execute()) {
        echo "Reserva cancelada com sucesso.";
    } else {
        echo "Erro ao cancelar reserva.";
    }
}
?>
