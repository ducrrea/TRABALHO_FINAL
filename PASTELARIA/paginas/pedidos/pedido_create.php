<?php
session_start();
require_once "../conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcliente = intval($_POST['cliente_id'] ?? 0);
    $itens_json = $_POST['itens_produtos'] ?? '';

    if (empty($idcliente) || empty($itens_json)) {
        header("Location: produtos_read.php?erro=dados_invalidos");
        exit();
    }

    $sacola = json_decode($itens_json, true);

    if (empty($sacola)) {
        header("Location: produtos_read.php?erro=sacola_vazia");
        exit();
    }

    try {
        // Inicia transação para garantir consistência no PostgreSQL
        $conexao->beginTransaction();

        // Valores padrão para chaves estrangeiras obrigatórias do seu banco
        $idstatus = 1;  // Geralmente o ID 1 na tabela 'status_pedidos' significa 'Pendente' / 'Em preparo'
        $idusuario = 1; // ID padrão do usuário/atendente que registrou o pedido

        // Prepara o insert baseado exatamente nas colunas da imagem enviada
        $sql = "INSERT INTO pedidos (idcliente, idusuario, idprodutos, quantidade, idstatus) 
                VALUES (:idcliente, :idusuario, :idprodutos, :quantidade, :idstatus)";
        $stmt = $conexao->prepare($sql);

        // Como sua tabela une o produto diretamente na linha do pedido, inserimos cada item da sacola
        foreach ($sacola as $item) {
            $idproduto = intval($item['id']);
            $qtd = intval($item['quantidade']);

            $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
            $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
            $stmt->bindParam(':idprodutos', $idproduto, PDO::PARAM_INT);
            $stmt->bindParam(':quantidade', $qtd, PDO::PARAM_INT);
            $stmt->bindParam(':idstatus', $idstatus, PDO::PARAM_INT);
            
            $stmt->execute();
        }

        $conexao->commit();
        header("Location: pedidos_read.php?sucesso=pedido_realizado");
        exit();

    } catch (PDOException $e) {
        if ($conexao->inTransaction()) {
            $conexao->rollBack();
        }
        echo "<h3>Erro ao registrar pedido no PostgreSQL:</h3>" . $e->getMessage();
        echo "<br><a href='produtos_read.php'>Voltar e tentar novamente</a>";
        exit();
    }
} else {
    header("Location: produtos_read.php");
    exit();
}