<?php
require_once "../conexao_bd.php";

// verifica se os campos obrigatórios foram enviados
if (isset($_POST["nome"]) && isset($_POST["senha"])) {

    $nome = trim($_POST["nome"]);
    $senha_pura = $_POST["senha"];

    // vai validar para evitar campos vazios
    if (empty($nome) || empty($senha_pura)) {
        header("Location: usuario_create.php?erro=campos_vazios");
        exit();
    }

    // transforma a senha em uma hash segura e irreversível
    $senha_criptografada = password_hash($senha_pura, PASSWORD_DEFAULT);

    // prepara a SQL usando a variável criptografada, aqui vai ser onde vai salvar no meu banco de dados
    $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha_criptografada);

    // ai executa e redireciona direto para o read
    if ($stmt->execute()) {
        header("Location: usuario_read.php?sucesso=cadastrado");
        exit();
    } else {
        header("Location: usuario_create.php?erro=db_error");
        exit();
    }
} else {
    header("Location: usuario_read.php");
    exit();
}
?>