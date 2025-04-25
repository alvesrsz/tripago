<?php
session_start();
$nomeUsuario = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tripago - Hotéis</title>
  <link rel="icon" type="image/png" href="/assets/favicon.png">
  <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>

<?php if (isset($_GET['logout'])): ?>
  <div class="logout-message" id="logoutMessage">Você saiu com sucesso.</div>
<?php endif; ?>

<?php if (isset($_SESSION['id'])): ?>
    <a href="php/minhas-reservas.php"></a>
<?php endif; ?>


  <header>
    <div class="logo">
      <?php echo $nomeUsuario ? "Bem-vindo, $nomeUsuario!" : "Tripago"; ?>
    </div>
    <nav>
      <ul>
        <li><a href="#inicio">Início</a></li>
		<?php if ($nomeUsuario): ?>
        <li><a href="php/minhas-reservas.php">Reservas</a></li>
		<?php endif; ?>
        <li><a href="#hoteis">Hotéis</a></li>
        <li><a href="#contato">Contato</a></li>
        <?php if ($nomeUsuario): ?>
          <li><a href="php/logout.php" class="login-btn">Logout</a></li>
        <?php else: ?>
          <li><a href="php/login.php" class="login-btn">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
  <a href="php/admin.php" class="btn-roxo" style="margin: 30px; display: inline-block;">Painel</a>
<?php endif; ?>



  
  <section class="hero animar" id="inicio">
    <div class="hero-content">
      <h1>Encontre o hotel perfeito</h1>
      <p>Descubra acomodações incríveis com conforto e praticidade.</p>
      <a href="#hoteis" class="btn-roxo">Buscar hotéis</a>
    </div>
  </section>


  <div class="filtro-cidade animar" id="reservas">
    <label for="cidade">Filtro por cidade:</label>
    <select id="cidade">
      <option value="brasilia">Brasília</option>
    </select>
  </div>


<section class="destaques animar" id="hoteis">
  <h2>Destaques de Hotéis</h2>

  <div class="carrossel-wrapper">

    <button class="carrossel-btn left" onclick="scrollCarrossel(-1)">&#10094;</button>


    <div class="cards-container" id="carrosselHoteis">

      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/96/2c/6e/novo-projeto.jpg?w=900&h=500&s=1" alt="Hotel Royal">
        <h3>Hotel Royal Tulip Brasilia</h3>
        <p>Uma verdadeira experiência de luxo à beira do lago.</p>
        <a href="/../html/hotelroyal.html" class="btn-reservar">Reservar</a>
      </div>

      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/39/b8/c7/melia-brasil-21.jpg?w=900&h=500&s=1" alt="Hotel Melia Brasil21">
        <h3>Melia Brasil 21</h3>
        <p>Elegância e conforto em uma localização privilegiada de Brasília.</p>
        <a href="html/meliabrasil.html" class="btn-reservar">Reservar</a>
      </div>
      
      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/4d/1c/8f/recepcao.jpg?w=1000&h=-1&s=1" alt="Manhattan Plaza Hotel">
        <h3>Manhattan Plaza</h3>
        <p>Um equilíbrio perfeito entre conforto e praticidade no centro.</p>
        <a href="html/manhattan.html" class="btn-reservar">Reservar</a>
      </div>
        
      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/83/29/66/villa-triacca-eco-pousada.jpg?w=900&h=500&s=1" alt="Villa Triacca Hotel">
        <h3>Villa Triacca Hotel</h3>
        <p>Um refúgio encantador rodeado pela natureza. Ideal para renovar as energias.</p>
        <a href="html/villatriacca.html" class="btn-reservar">Reservar</a>
      </div>
         
      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/58/13/3a/recepcao.jpg?w=1000&h=-1&s=1" alt="SIA Park Hotel">
        <h3>SIA Park Executive Hotel</h3>
        <p>Excelente para viagens de negócios com uma pitada de tranquilidade.</p>
        <a href="html/siapark.html" class="btn-reservar">Reservar</a>
      </div>
	             
      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/12/bf/ad/b3/nobile-suites-monumental.jpg?w=1000&h=-1&s=1" alt="Nobile Suites Monumental">
        <h3>Nobile Suítes Monumental</h3>
        <p>Estrutura moderna, com facilidades pensadas para a hospedagem perfeita.</p>
        <a href="html/nobile.html" class="btn-reservar">Reservar</a>
		    </div>
		           
      <div class="card">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/08/5b/7c/c1/windsor-brasilia-hotel.jpg?w=1000&h=-1&s=1" alt="Windsor Brasilia">
        <h3>Windsor Brasilia Hotel</h3>
        <p>Ideal para momentos de lazer com um toque de aventura.</p>
        <a href="html/windsor.html" class="btn-reservar">Reservar</a>
		</div>

	

  
    <button class="carrossel-btn right" onclick="scrollCarrossel(1)">&#10095;</button>
  </div>
</section>


  

<div class="buscar-destino animar">
  <h2>Encontre seu próximo destino</h2>
  <form onsubmit="return redirecionarCidade()" class="busca-form">
    <select id="seletor-cidade" required>
      <option value="">Selecione uma cidade</option>
      <option value="html/rio.html">Rio de Janeiro</option>
      <option value="html/saopaulo.html">São Paulo</option>
      <option value="html/lisboa.html">Lisboa</option>
      <option value="html/novayork.html">Nova York</option>
      <option value="html/paris.html">Paris</option>
    </select>
    <button type="submit">Ir</button>
  </form>
</div>

<script>
  function redirecionarCidade() {
    const select = document.getElementById('seletor-cidade');
    const pagina = select.value;

    if (pagina) {
      window.location.href = pagina;
    }

    return false; 
  }
</script>



 
  <section class="app-promo animar">
    <h2>Baixe nosso app</h2>
    <p>Reserve hotéis com mais facilidade direto do seu celular.</p>
    <div class="botoes-app">
      <a href="#" class="btn-app">📱 Google Play</a>
      <a href="#" class="btn-app">🍎 App Store</a>
    </div>
  </section>

 
  <section class="beneficios animar">
    <h2>Por que reservar conosco?</h2>
    <ul>
      <li><span>💸</span> Melhores preços</li>
      <li><span>📞</span> Suporte 24h</li>
      <li><span>🏆</span> Hotéis premiados</li>
      <li><span>🔐</span> Pagamento seguro</li>
    </ul>
  </section>


<section class="avaliacoes-section animar">
  <h2 class="avaliacoes-titulo piscar-luz">AVALIAÇÕES</h2>
  <p class="avaliacoes-subtitulo">DO NOSSO SERVIÇO</p>

  <div class="avaliacoes-duas-colunas">
  
    <div class="coluna">
      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/491865970_959150996098257_7158567282920534273_n.jpg?ccb=11-4&oh=01_Q5Aa1QFkp9aLYPJvOuoIo4JmJOLFBzpFtSTIROtk7GHn6BCCFA&oe=68174878&_nc_sid=5e03e0&_nc_cat=100" alt="Wallace Alves" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Wallace Alves</h3>
          <p class="avaliacao-tempo">há 1 semana</p>
      <p class="avaliacao-texto">Usei o Tripago pra reservar um hotel em SP. Funcionou tudo certinho. Muito fácil!</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/469590153_2050317305426136_4757068071533726567_n.jpg?ccb=11-4&oh=01_Q5Aa1QHIlpEefg3Dn174Q64qGHMr985q5gRPhooNHh_4Y1bQWw&oe=680FFE8D&_nc_sid=5e03e0&_nc_cat=104" alt="Jose Henrique" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Jose Henrique</h3>
          <p class="avaliacao-tempo">há 3 semanas</p>
      <p class="avaliacao-texto">Gostei bastante! Consegui um bom preço e o hotel era ótimo. Recomendo.</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/485126496_1343698310089649_5205745442026941531_n.jpg?ccb=11-4&oh=01_Q5Aa1QHC7Ovwes7KedG1zpSyDbqBLjHbzWIW7neHYa696tE9lg&oe=68137716&_nc_sid=5e03e0&_nc_cat=102" alt="Laura" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Victor Hugo</h3>
          <p class="avaliacao-tempo">há 1 mês</p>
      <p class="avaliacao-texto">Tive dúvida na reserva e o suporte me ajudou na hora. Atendimento rápido!</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/463104078_3933545906918816_8965358961860119322_n.jpg?ccb=11-4&oh=01_Q5Aa1QEh828wqiAoQZwfbb4DgWOL4IVOmGAtv2uKJk102HQLXQ&oe=68159EF2&_nc_sid=5e03e0&_nc_cat=110" alt="Emilly Rodrigues" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Emilly Rodrigues</h3>
          <p class="avaliacao-tempo">há 2 meses</p>
          <p class="avaliacao-texto">Muito bom, recebi total ajuda do suporte durante a reserva. Interface do site muito boa...</p>
        </div>
      </div>
    </div>


    <div class="coluna">
      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/473398193_1175305350671871_715522401175077118_n.jpg?ccb=11-4&oh=01_Q5Aa1QEtipFu6pqUNWmVPtyx1T6L99cV3jIIc9MlbXDxC_fZLQ&oe=68135969&_nc_sid=5e03e0&_nc_cat=105" alt="Pedro Henrick" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Pedro Henrick</h3>
          <p class="avaliacao-tempo">há 2 semanas</p>
          <p class="avaliacao-texto">Reservei tudo certinho, muito agradecido pelo trabalho, recomendo D+...</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/427919447_453543757071150_8251673734662593914_n.jpg?ccb=11-4&oh=01_Q5Aa1QGVjRJJPxqAhYLDrQBS0WzZ3Po6S6r9MZ4a3_J-udi8zg&oe=68136C99&_nc_sid=5e03e0&_nc_cat=101" alt="Daniel Marinho" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Daniel Marinho</h3>
          <p class="avaliacao-tempo">há 1 mês</p>
      <p class="avaliacao-texto">Fiz a reserva pelo celular, sem complicação. Muito bom mesmo!</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/377039033_1398317540749467_2855477071146143448_n.jpg?ccb=11-4&oh=01_Q5Aa1QGt6dscV4XNC5qItl0fxMvcF19qUGl8oAuyh3_8Ln9ZCQ&oe=681389EC&_nc_sid=5e03e0&_nc_cat=106" alt="Danielle" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Danielle</h3>
          <p class="avaliacao-tempo">há 1 mês</p>
          <p class="avaliacao-texto">Por enquanto está tudo certo, reservei e chegou quase na hora, tudo certinho...</p>
        </div>
      </div>

      <div class="avaliacao-card">
        <img src="https://media-bsb1-1.cdn.whatsapp.net/v/t61.24694-24/473398393_1298964031413900_3070906050916906002_n.jpg?ccb=11-4&oh=01_Q5Aa1QFMcobg0aF3RiUgZLpxC9XTTvHPLVIbvsa_C_A1DzlCvg&oe=6813841D&_nc_sid=5e03e0&_nc_cat=107" alt="Luis Brito" class="avaliacao-avatar">
        <div>
          <h3 class="avaliacao-nome">Luís Brito</h3>
          <p class="avaliacao-tempo">há 7 meses</p>
          <p class="avaliacao-texto">Site confiável, compra fácil de fazer, se tiver problema pode contar com a equipe...</p>
        </div>
      </div>
    </div>
  </div>
</section>
    
    <section class="faq animar">
      <h2>Perguntas Frequentes</h2>
      <div class="pergunta">
        <h3>❓ Como faço uma reserva?</h3>
        <p>Basta buscar o hotel desejado, preencher os dados e clicar em "Reservar".</p>
      </div>
      <div class="pergunta">
        <h3>❓ É possível cancelar gratuitamente?</h3>
        <p>Sim, muitos hotéis oferecem cancelamento gratuito. Verifique antes de reservar.</p>
      </div>
      <div class="pergunta">
        <h3>❓ O pagamento é seguro?</h3>
        <p>Sim! Utilizamos criptografia e meios confiáveis como cartão e Pix.</p>
      </div>
    </section>
  </section>

  
  <section class="suporte-section animar" id="contato">
    <div class="suporte-container">

     
      <img src="https://katinu.com.br/imagens/suporte/suporte-servicos.png" alt="Suporte" class="suporte-img" />

      
      <div class="suporte-conteudo">
        <h2>SUPORTE</h2>
        <p>Precisa de ajuda? Tem dúvidas? Fale com a gente:</p>

        <a href="https://wa.me/61993277946" class="suporte-botao" target="_blank">
          <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
          WhatsApp
        </a>

        <a href="mailto:contato@tripago.com" class="suporte-botao">
          <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="E-mail" />
          E-mail
        </a>
      </div>
    </div>
  </section>


  <footer class="rodape animar">
    <div class="links">
      <a href="#">Sobre Nós</a>
      <a href="#contato">Contato</a>
      <a href="#">Termos de Uso</a>
      <a href="#">Privacidade</a>
    </div>
    <p>&copy; 2025 Tripago - Hotéis. Todos os direitos reservados.</p>
  </footer>

<script>
  setTimeout(function () {
    setTimeout(function () {
      const msg = document.getElementById('logoutMessage');
      if (msg) {
        msg.style.display = 'none';
      }
    }, 4000); 
  }, 4000); 
</script>


<script>
  function scrollCarrossel(direction) {
    const carrossel = document.getElementById('carrosselHoteis');
    const cardWidth = carrossel.querySelector('.card').offsetWidth + 16; 
    carrossel.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
  }
</script>


</body>
</html>