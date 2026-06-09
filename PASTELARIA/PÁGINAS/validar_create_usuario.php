
<?php

require_once "conexao_bd.php";

if(isset($_POST["nome"])){

    $nome = trim($_POST["nome"]);
    $senha = "123456";

    $sql = "INSERT INTO usuarios (nome, senha)
            VALUES (:nome, :senha)";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':senha', $senha);

    $stmt->execute();
} else {
    header("Location: usuario_read.php");
    exit();
}
?>