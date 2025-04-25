<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel - Hotéis</title>
  <link rel="icon" type="image/png" href="/assets/favicon.png">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<a href="/../../index.php" class="botao-voltar" title="Voltar">
  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 18l-6-6 6-6" stroke="white" stroke-width="3" fill="none" />
  </svg>
</a>
  <main>
    <h1 class="avaliacoes-titulo">Gerenciamento de Hotéis</h1>

    <form id="formHotel" enctype="multipart/form-data">
      <input type="hidden" id="id" name="id">
      <input type="text" id="nome" name="nome" placeholder="Nome do hotel" required>
      <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
      <input type="text" id="endereco" name="endereco" placeholder="Endereço" required>
      <input type="text" id="descricao" name="descricao" placeholder="Descrição" required>
      <input type="number" id="avaliacao" name="avaliacao" placeholder="Avaliação" step="0.1" required>
      <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
      <input type="text" id="site" name="site" placeholder="Site" required>
      <input type="text" id="imagem" name="imagem" placeholder="URL da imagem" required>
      <button type="submit">Salvar</button>
    </form>

    <table id="tabelaHoteis">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cidade</th>
          <th>Endereço</th>
          <th>Descrição</th>
          <th>Avaliação</th>
          <th>Telefone</th>
          <th>Site</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </main>

<script>
  const form = document.getElementById('formHotel');
  const tabela = document.querySelector('#tabelaHoteis tbody');

  async function carregarHoteis() {
    try {
      const res = await fetch('/api/hoteis/listar.php');
      const dados = await res.json();
      tabela.innerHTML = '';
      dados.forEach(hotel => {
        const linha = document.createElement('tr');
        linha.innerHTML = `
          <td>${hotel.id}</td>
          <td>${hotel.nome}</td>
          <td>${hotel.cidade}</td>
          <td>${hotel.endereco}</td>
          <td>${hotel.descricao}</td>
          <td>${hotel.avaliacao}</td>
         <td>${hotel.telefone}</td>
         <td>${hotel.site}</td>
          <td>
            <button class="btn-editar" data-hotel='${JSON.stringify(hotel)}'>Editar</button>
            <button class="btn-deletar" data-id="${hotel.id}">Excluir</button>
          </td>
        `;
        tabela.appendChild(linha);
      });
    } catch (error) {
      console.error("Erro ao carregar hotéis:", error);
    }
  }

  tabela.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-editar')) {
      const hotel = JSON.parse(e.target.dataset.hotel);
      for (let key in hotel) {
        if (form[key]) form[key].value = hotel[key];
      }
      document.getElementById('id').value = hotel.id;
    }

    if (e.target.classList.contains('btn-deletar')) {
      const id = e.target.dataset.id;
      deletar(id);
    }
  });

  async function deletar(id) {
    try {
     const res = await fetch(`/api/hoteis/deletar.php`, {
        method: 'POST',  
        body: new URLSearchParams({ id }) 
      });

      const texto = await res.text();
      console.log("Resposta ao deletar:", texto);

      if (res.ok) {
        carregarHoteis();
      } else {
        console.error("Erro ao deletar hotel:", texto);
      }
    } catch (error) {
      console.error("Erro ao deletar hotel:", error);
    }
  }

 form.onsubmit = async e => {
  e.preventDefault();

  const dados = new FormData(form);
  const id = dados.get('id');
 const url = id ? '/api/hoteis/editar.php' : '/api/hoteis/criar.php';

  try {
    const res = await fetch(url, {
      method: 'POST',
      body: dados
    });

    const responseText = await res.text();
    console.log("Resposta do servidor:", responseText);

    if (res.ok) {
      carregarHoteis();
      form.reset();
      document.getElementById('id').value = '';
    } else {
      console.error("Erro no servidor:", responseText);
    }
  } catch (error) {
    console.error("Erro na requisição:", error);
  }
};



  carregarHoteis();
</script>

</body>
</html>
