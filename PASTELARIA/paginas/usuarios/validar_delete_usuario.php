<?php
session_start();
require_once "../conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['confirmar_deletar'])) {
    $id = intval($_POST['id']);

    if (!empty($id)) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Sucesso: Volta para o read, onde o usuário já terá sumido!
            header("Location: usuario_read.php?sucesso=deletado");
            exit();
        } else {
            header("Location: usuario_delete.php?erro=db_error");
            exit();
        }
    } else {
        header("Location: usuario_delete.php?erro=id_invalido");
        exit();
    }
} else {
    header("Location: usuario_read.php");
    exit();
}
?>