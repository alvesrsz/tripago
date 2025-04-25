<?php
include_once(__DIR__ . '/../../php/conexao.php');


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data); 
    $reserva_id = $data['id']; 
    $data_entrada = $data['data_entrada'];
    $data_saida = $data['data_saida'];

 
    if (empty($reserva_id) || empty($data_entrada) || empty($data_saida)) {
        echo json_encode(["error" => "Todos os campos são obrigatórios"]);
        exit;
    }

  
    $sql = "UPDATE reservas SET data_entrada = ?, data_saida = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $data_entrada, $data_saida, $reserva_id);


    if ($stmt->execute()) {
        echo json_encode(["success" => "Reserva atualizada com sucesso"]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar reserva"]);
    }
}
?>
