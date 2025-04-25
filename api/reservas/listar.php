<?php
include_once(__DIR__ . '/../../php/conexao.php');


session_start();
if (!isset($_SESSION['id'])) {
    echo json_encode(["error" => "Usuário não autenticado"]);
    exit;
}

$usuario_id = $_SESSION['id'];


$sql = "SELECT r.id, h.nome AS hotel, r.data_entrada, r.data_saida
        FROM reservas r
        JOIN hoteis h ON r.hotel_id = h.id
        WHERE r.usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $reservas = [];
    while ($reserva = $result->fetch_assoc()) {
        $reservas[] = $reserva;
    }
    echo json_encode($reservas);
} else {
    echo json_encode(["error" => "Nenhuma reserva encontrada"]);
}
?>
