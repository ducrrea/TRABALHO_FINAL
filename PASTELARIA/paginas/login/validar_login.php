<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "../conexao_bd.php";

$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Buscamos apenas pelo nome, pois a senha criptografada não pode ser comparada direto no SQL
$sql = "SELECT * FROM usuarios
        WHERE nome = :nome";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(':nome', $nome);

$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// se encontrou o usuário, agora verificamos se a senha digitada confere com o banco
if ($usuario && password_verify($senha, $usuario['senha'])) {

    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];

    header("Location: ../home.php");
    exit();

} else {
    // ---- BLOCO DE DIAGNÓSTICO TEMPORÁRIO ----
    echo "<h2>Diagnóstico de Falha de Login:</h2>";
    
    if (!$usuario) {
        echo "<p style='color:red; font-weight:bold;'>❌ ERRO: O usuário digitado NÃO foi encontrado no banco de dados!</p>";
        echo "Verifique se a tabela 'usuarios' não ficou vazia ou se o e-mail/login foi digitado certo.";
    } else {
        echo "<p style='color:orange; font-weight:bold;'>⚠️ AVISO: O usuário existe, mas a SENHA está incorreta!</p>";
        echo "A senha digitada não corresponde ao hash criptografado salvo no banco de dados.";
    }
    
    echo "<br><br><a href='login.php'>Voltar para o Login</a>";
    exit();
    // ----------------------------------------
}
?>