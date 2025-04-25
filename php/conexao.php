<?php
$servername = "localhost";        // Servidor local
$username = "root";              // Usuário padrão do MySQL no XAMPP
$password = "";                  // Sem senha por padrão
$database = "tripagodb";         // Nome do seu banco de dados local

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Charset para acentuação correta
$conn->set_charset("utf8mb4");

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
