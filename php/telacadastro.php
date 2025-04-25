<?php
include('../php/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $confirmar_senha = $_POST['confirmar_senha'];
  $data_nascimento = $_POST['data_nascimento'];
  $cidade_bairro = $_POST['cidade_bairro'];

  if ($senha !== $confirmar_senha) {
    echo "<script>alert('As senhas não coincidem.');</script>";
  } else {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
  $tipo = 'user';

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, data_nascimento, cidade_bairro, tipo) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss", $nome, $email, $senha_hash, $data_nascimento, $cidade_bairro, $tipo);

    if ($stmt->execute()) {
      echo "<script>
              alert('Cadastro realizado com sucesso!');
              window.location.href = 'login.php';
            </script>";
      exit(); 
    } else {
      echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Criar Conta</title>
  <link rel="icon" type="image/png" href="/assets/favicon.png">
  <link rel="stylesheet" href="../css/cadastro.css" />
</head>
<body>
  <div class="overlay">
    <form class="register-form" method="POST" action="">
      <h1>Criar conta</h1>
      <input type="text" name="nome" placeholder="Nome completo" required />
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <input type="password" name="confirmar_senha" placeholder="Confirmação de Senha" required />
      <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required />
      <input type="text" name="cidade_bairro" placeholder="Cidade/Bairro" required />

      <div class="progress-bar">
        <div class="progress"></div>
      </div>

      <button type="submit">Próximo</button>
    </form>
  </div>
</body>
</html>
