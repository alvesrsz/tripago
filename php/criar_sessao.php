<?php
session_start();


$data = json_decode(file_get_contents("php://input"), true);


if (isset($data['usuario_id']) && isset($data['nome'])) {
    $_SESSION['id'] = $data['usuario_id'];
    $_SESSION['nome'] = $data['nome'];
    $_SESSION['tipo'] = $data['tipo'] ?? 'usuario';

    
    echo json_encode(['success' => true]);
} else {
    
    echo json_encode(['success' => false, 'mensagem' => 'Dados incompletos para iniciar sessão']);
}
?>
