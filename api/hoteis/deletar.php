<?php
include(__DIR__ . '/../../php/conexao.php');

header('Content-Type: application/json');


if (isset($_POST['id'])) {
    $id = $_POST['id'];

 
    $sql = "DELETE FROM hoteis WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $id);


        if ($stmt->execute()) {
            echo json_encode(["success" => "Hotel deletado com sucesso."]);
        } else {
            echo json_encode(["error" => "Erro ao deletar: " . $stmt->error]);
        }


        $stmt->close();
    } else {
        echo json_encode(["error" => "Erro ao preparar a consulta: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}


$conn->close();
?>
