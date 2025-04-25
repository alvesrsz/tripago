<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

include 'conexao.php';
$usuario_id = $_SESSION['id'];

$sql = "SELECT r.id, h.nome AS hotel, h.valor, r.data_entrada, r.data_saida, r.data_reserva
        FROM reservas r
        JOIN hoteis h ON r.hotel_id = h.id
        WHERE r.usuario_id = ?
        ORDER BY r.data_entrada DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <link rel="stylesheet" href="/../css/minhas-reservas.css">
</head>
<div id="mensagem-reserva" style="display: none;" class="mensagem-reserva"></div>


<body>
<a href="../../index.php" class="botao-voltar" title="Voltar">
  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 18l-6-6 6-6" stroke="white" stroke-width="3" fill="none" />
  </svg>
</a>

<h1>Reservas</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Hotel</th>
            <th>Data da Reserva</th>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($reserva = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($reserva['hotel']) ?></td>
            <td><?= date('d/m/Y', strtotime($reserva['data_reserva'])) ?></td>
            <td><?= date('d/m/Y', strtotime($reserva['data_entrada'])) ?></td>
            <td>
                <?= (!empty($reserva['data_saida']) && $reserva['data_saida'] !== '0000-00-00')
                    ? date('d/m/Y', strtotime($reserva['data_saida']))
                    : '<em>sem data</em>' ?>
            </td>
            <td>R$ <?= number_format($reserva['valor'], 2, ',', '.') ?></td>
            <td>

    <button class="botao-acao cancelar" data-id="<?= $reserva['id'] ?>">Cancelar</button>
    <button class="botao-acao finalizar" data-id="<?= $reserva['id'] ?>">Finalizar</button>
    <button class="botao-acao checkin" data-id="<?= $reserva['id'] ?>">Check-in</button>

            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
function mostrarMensagem(texto, sucesso = true) {
    const div = document.getElementById('mensagem-reserva');
    div.textContent = texto;
    div.style.display = 'block';
    div.style.backgroundColor = sucesso ? '#4CAF50' : '#f44336';
    div.style.color = 'white';
    div.style.padding = '10px';
    div.style.margin = '20px';
    div.style.borderRadius = '5px';
    div.style.textAlign = 'center';
    div.style.fontWeight = 'bold';

    setTimeout(() => div.style.display = 'none', 4000);
}

document.querySelectorAll('.botao-acao.finalizar').forEach(btn => {
    btn.addEventListener('click', () => {
        const reservaId = btn.getAttribute('data-id');
        fetch('finalizar-reserva.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'reserva_id=' + encodeURIComponent(reservaId)
        })
        .then(res => res.text())
        .then(texto => mostrarMensagem(texto, true))
        .catch(() => mostrarMensagem('Erro ao finalizar reserva', false));
    });
});

document.querySelectorAll('.botao-acao.checkin').forEach(btn => {
    btn.addEventListener('click', () => {
        const reservaId = btn.getAttribute('data-id');
        fetch('checkin-reserva.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'reserva_id=' + encodeURIComponent(reservaId)
        })
        .then(res => res.text())
        .then(texto => mostrarMensagem(texto, true))
        .catch(() => mostrarMensagem('Erro ao realizar check-in', false));
    });
});
document.querySelectorAll('.botao-acao.cancelar').forEach(btn => {
    btn.addEventListener('click', () => {
        const reservaId = btn.getAttribute('data-id');
        fetch('cancelar-reserva.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'reserva_id=' + encodeURIComponent(reservaId)
        })
        .then(res => res.text())
        .then(texto => mostrarMensagem(texto, true))
        .catch(() => mostrarMensagem('Erro ao cancelar reserva', false));
    });
});

</script>


</body>
</html>
