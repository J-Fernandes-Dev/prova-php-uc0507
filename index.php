<?php
// Configuração da ligação à BD

$host = 'localhost'; // O professor tem 'db' porque usa Docker, no teu MAMP usa 'localhost'
$db   = 'prova_web';
$user = 'root';
$pass = 'root'; // Senha padrão do MAMP no Mac
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erro de ligação: " . $e->getMessage());
}

// Consulta usando PDO
$stmt = $pdo->query('SELECT titulo, descricao FROM artigos');
$artigos = $stmt->fetchAll();
// Consulta usando PDO
//atenção que isto nao funciona sem a ligação base dados....
//$stmt = $pdo->query('SELECT titulo, descricao FROM artigos');
//$artigos = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="pt">
 
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Início — Página Dinâmica</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Display:wght@700;900&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav>
    <span class="nav-logo">UC0507</span>
    <a href="index.php" class="active">Início</a>
    <a href="sobre.html">Sobre</a>
    <a href="contacto.html">CONTACTO</a>
  </nav>

  <section class="section">
    <div class="section-header">
      <span class="section-count">Da Base de Dados — 3 artigos</span>
      <p class="info">Estes artigos devem ser recolhidos da base dados</p>
    </div>

    <div class="articles-grid">

<!-- Estes artigos devem ser os que veem da base dados;
 ex:   foreach ($artigos as $artigo): etc etc -->
    
    <?php 
    // Iniciamos o ciclo dinâmico sobre os artigos que vieram da BD
    if (!empty($artigos)):
        foreach ($artigos as $artigo): 
        ?>
            <article class="article-card">
                <h3 class="article-title"><?php echo htmlspecialchars($artigo['titulo']); ?></h3>
                
                <p class="article-excerpt"><?php echo htmlspecialchars($artigo['descricao']); ?></p>
            </article>
        <?php 
        endforeach; 
    else:
        // Caso a ligação funcione mas não existam dados inseridos na tabela
        echo "<p style='color: #ffaa00; grid-column: 1/-1;'>Nenhum artigo encontrado na base de dados.</p>";
    endif; 
    ?>

</div>
<!-- fim dos artigos -->
    </div>
  </section>

  <footer>
    <span>© 2026 UC0507. Todos os direitos reservados.</span>
    <span>
      <a href="sobre.html">Sobre</a> |
      <a href="contacto.html">Contacto</a>
    </span>
  </footer>

</body>

</html>