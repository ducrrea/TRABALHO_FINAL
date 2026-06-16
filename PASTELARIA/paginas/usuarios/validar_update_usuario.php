<?php 
session_start();
require_once "../conexao_bd.php";

//aqui vai verificar se os dados necessarios foram colocados
if(isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['senha'])){
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $senha_pura = ($_POST['senha']);

    //vai garantir que nao enviou nada vazio
    if (empty($id) || empty($nome) || empty($senha_pura)){
        header("Location: usuario_update.php?erro=campos_invalidos");
        exit();
    }

    $senha_criptografada = password_hash($senha_pura, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET nome = :nome, senha = :senha WHERE id = :id";
    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(":nome", $nome);
    // CORRIGIDO: mudou de $senha para $senha_criptografada
    $stmt->bindParam(":senha", $senha_criptografada); 
    // CORRIGIDO: mudou de $is para $id
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()){
        header("Location: usuario_update.php?sucesso=atualizado");
        exit();
    } else {
        header("Location: usuario_update.php?erro=erro_banco");
        exit();
    }

} else {
    // Se for acessado incorretamente, joga de volta à tela de edição
    header("Location: usuario_update.php");
    exit();
}
    
?>