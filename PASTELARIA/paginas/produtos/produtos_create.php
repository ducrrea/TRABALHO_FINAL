<?php
// Força o PHP a mostrar todos os erros na tela (impede tela branca ou redirecionamento fantasma)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Teste de localização do arquivo de conexão
if (!file_exists("conexao_bd.php")) {
    echo "<h3>Erro de Estrutura de Pastas:</h3>";
    echo "<p style='color:red;'>O arquivo <strong>conexao_bd.php</strong> não foi encontrado na pasta 'PÁGINAS'.</p>";
    echo "<p>Se ele estiver na pasta de trás, mude a linha do require para: <code>require_once '../conexao_bd.php';</code></p>";
    exit();
}

require_once "conexao_bd.php";

// Verifica se a conexão com o banco realmente existe
if (!isset($conexao)) {
    echo "<h3>Erro Crítico:</h3> A variável de conexão <code>\$conexao</code> não foi definida pelo arquivo conexao_bd.php.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mostra o que chegou do formulário para sabermos se o HTML enviou certo
    echo "";

    $nome = trim($_POST['nome'] ?? '');
    $preco = floatval($_POST['preco'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');

    if (!empty($nome) && $preco > 0 && !empty($descricao)) {
        try {
            $sql = "INSERT INTO produtos (nome, preco, descricao) VALUES (:nome, :preco, :descricao)";
            $stmt = $conexao->prepare($sql);
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':descricao', $descricao);

            if ($stmt->execute()) {
                echo "<h3>Sucesso total!</h3> O produto foi gravado no banco de dados.";
                echo "<br><a href='produtos_read.php' style='padding:10px 20px; background:#775a19; color:white; text-decoration:none; border-radius:5px;'>Voltar para a lista de produtos</a>";
                exit();
            } else {
                echo "<h3>Erro interno:</h3> O comando executou mas o banco de dados não salvou.";
                exit();
            }
        } catch (PDOException $e) {
            echo "<h3>Erro detectado no Banco de Dados (PostgreSQL):</h3>";
            echo "<p style='color:red; font-weight:bold;'>" . $e->getMessage() . "</p>";
            echo "<br><a href='produtos_read.php'>Voltar</a>";
            exit();
        }
    } else {
        echo "<h3>Erro de Validação:</h3> Alguns dos campos foi enviado em branco.";
        echo "<br>Nome recebido: " . htmlspecialchars($nome);
        echo "<br>Preço recebido: " . htmlspecialchars($preco);
        echo "<br>Descrição recebida: " . htmlspecialchars($descricao);
        echo "<br><a href='produtos_read.php'>Voltar</a>";
        exit();
    }
} else {
    echo "<h3>Erro de Acesso:</h3> Este arquivo só aceita envios via formulário (POST).";
    echo "<br><a href='produtos_read.php'>Voltar</a>";
    exit();
}
?>