<?php
// Forçar exibição de erros para o caso de me enganar em alguma variável
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ==========================================
// 1. limpar/Sanitizar as variáveis
// ==========================================
// Usamos o filter_input para recolher e limpar os dados do POST de forma segura
$nome     = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$assunto  = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
$mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

// Verificação se algum campo ficou vazio ou se o email é inválido
if (!$nome || !$email || !$assunto || !$mensagem) {
    die("Erro: Por favor, preencha todos os campos corretamente. O email deve ser válido.");
}

// =========================================================================
// 2. Criação da ligação à base de dados e registo dos campos do formulário
// =========================================================================
$host    = 'localhost'; // Como tenho MAMP e não Docker uso 'localhost'
$db      = 'prova_web';
$user    = 'root';
$pass    = 'root';    // Senha padrão do MAMP no Mac
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";
// Bloco de segurança para evitar SQL Injection e garantir que erros sejam lançados como exceções
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Preparação da Query SQL para evitar SQL Injection
    $sql = "INSERT INTO contactos (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)";
    $stmt = $pdo->prepare($sql);
    
    // Execução passando os dados salvos do formulário
    $stmt->execute([
        ':nome'     => $nome,
        ':email'    => $email,
        ':assunto'  => $assunto,
        ':mensagem' => $mensagem
    ]);

    echo "<p style='color:green;'>Dados guardados na Base de Dados com sucesso!</p>";

} catch (PDOException $e) {
    die("Erro ao guardar na Base de Dados: " . $e->getMessage());
}

// ===============================================
// 3. Criação do ficheiro csv e adição dos campos
// ===============================================
$ficheiro_csv = 'contactos.csv';
$existe = file_exists($ficheiro_csv);

// Abertura do ficheiro em modo 'a' (append) para adicionar no fim sem apagar o anterior
$fp = fopen($ficheiro_csv, 'a');

if ($fp) {
    // Adição do cabeçalho para o ficheiro que acabou de ser criado
    if (!$existe) {
        fputcsv($fp, ['Nome', 'Email', 'Assunto', 'Mensagem', 'Data'], ',');
    }

    // Captura da data atual para ficar igual ao registo do print
    $data_atual = date('Y-m-d H:i:s');

    // Criação do array com a linha que vai ser injetada no CSV
    $linha_manual = '"' . $nome . '",' . $email . ',"' . $assunto . '","' . $mensagem . '","' . $data_atual . '"' . "\n";

    // Escrita da linha formatada em CSV usando a vírgula como separador
    fwrite($fp, $linha_manual);

    // Fecha o ponteiro do ficheiro
    fclose($fp);

    echo "<p style='color:green;'>Dados adicionados ao ficheiro contactos.csv com sucesso!</p>";
} else {
    echo "<p style='color:red;'>Erro ao abrir ou criar o ficheiro CSV.</p>";
}

// Botão simples para voltar para a página inicial
echo "<br><a href='index.php'>Voltar à Página Principal</a>";