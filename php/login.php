<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="icon" type="image/png" href="/assets/favicon.png">
  <link rel="stylesheet" href="/../css/login.css" />
</head>
<body>

  <div class="overlay">
    <form class="login-form" id="formLogin">
      <h1>Login</h1>
      <input type="email" id="email" placeholder="E-mail de acesso" required />
      <input type="password" id="senha" placeholder="Senha de acesso" required />
      <button type="submit">ENTRAR</button>
      <a href="#" class="forgot">ESQUECEU A SENHA?</a>
      <p class="signup">AINDA NÃO TEM UMA CONTA? <a href="telacadastro.php">CRIAR CONTA</a></p>
    </form>
  </div>

  <script>
    document.getElementById("formLogin").addEventListener("submit", async function (event) {
      event.preventDefault();

      const email = document.getElementById("email").value;
      const senha = document.getElementById("senha").value;

      try {
        const resposta = await fetch("https://tripago.infy.uk/api/reservas/login_api.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({ email, senha })
        });

        const dados = await resposta.json();

        if (dados.success) {
          localStorage.setItem("usuario_id", dados.usuario_id);
          localStorage.setItem("usuario_nome", dados.nome);

          
          await fetch("criar_sessao.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              usuario_id: dados.usuario_id,
              nome: dados.nome,
              tipo: dados.tipo || "usuario"
            })
          });

          alert("Login realizado com sucesso!");
          window.location.href = "/../index.php";
        } else {
          alert(dados.mensagem || "Erro no login.");
        }

      } catch (erro) {
        console.error("Erro ao tentar login:", erro);
        alert("Erro de conexão com o servidor.");
      }
    });
  </script>
</body>
</html>
