<?php
include '../../php/conexao.php';


if (isset($_GET['id'])) {
    $reserva_id = $_GET['id'];


    $sql = "DELETE FROM reservas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reserva_id);


    if ($stmt->execute()) {
        echo json_encode(["success" => "Reserva excluída com sucesso"]);
    } else {
        echo json_encode(["error" => "Erro ao excluir reserva"]);
    }
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}
?>
