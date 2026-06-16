<?php
session_start();

// 1. Importa a conexão com o banco de dados
require_once "../conexao_bd.php";

// 2. Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura os dados enviados pelo formulário do modal
    $nome = $_POST['nome'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $numero_residencia = $_POST['numero_residencia'] ?? ''; 
    $telefone = $_POST['telefone'] ?? '';

    // Validação simples para garantir que nenhum campo obrigatório foi enviado vazio
    if (!empty($nome) && !empty($cep) && !empty($numero_residencia) && !empty($telefone)) {
        try {
            // 3. Prepara o comando SQL de inserção
            // SE O SEU BANCO DEER ERRO DE COLUNA, O PHP VAI MOSTRAR NA TELA EXATAMENTE QUAL É O NOME CERTO
            $sql = "INSERT INTO clientes (nome, cep, numerocasa, telefone) 
                    VALUES (:nome, :cep, :numero_residencia, :telefone)";
            
            $stmt = $conexao->prepare($sql);

            // Vincula os valores com segurança
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':numero_residencia', $numero_residencia);
            $stmt->bindParam(':telefone', $telefone);

            // Executa a query no banco de dados
            if ($stmt->execute()) {
                // 4. SUCESSO: Redireciona de volta para a página principal
                header("Location: cliente_read.php?sucesso=cadastrado");
                exit();
            } else {
                echo "Erro ao tentar executar a gravação no banco de dados.";
                exit();
            }

        } catch (PDOException $e) {
            // Se der erro por conta do nome das colunas, o código vai parar aqui e te dizer o porquê!
            echo "<h3>Erro de Banco de Dados encontrado:</h3>";
            echo "<p style='color:red; font-weight:bold;'>" . $e->getMessage() . "</p>";
            echo "<p>Verifique se os nomes das colunas da tabela 'clientes' são exatamente: nome, cep, numero_residencia, telefone.</p>";
            exit();
        }
    } else {
        echo "Erro: Existem campos obrigatórios que vieram vazios do formulário.";
        print_r($_POST); // Mostra o que chegou no formulário
        exit();
    }
} else {
    echo "Erro: O arquivo cliente_create.php só aceita envios via POST.";
    exit();
}
?>