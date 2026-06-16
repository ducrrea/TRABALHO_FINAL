<?php
// 1. Inicia a sessão de forma segura
session_start();

// 2. Importa a conexão com o banco de dados
require_once "../conexao_bd.php";

// 3. Verifica se os dados do formulário de login foram enviados
if (isset($_POST['nome']) && isset($_POST['senha'])) {
    
    $nome = trim($_POST['nome']);
    $senha_pura = $_POST['senha'];

    if (empty($nome) || empty($senha_pura)) {
        // Se mandou campo vazio, volta para a tela de login (mude index.php para o nome da sua tela de login se for diferente)
        header("Location: index.php?erro=campos_vazios");
        exit();
    }

    try {
        // 4. Busca o usuário pelo nome na tabela do PostgreSQL
        $sql = "SELECT id, nome, senha FROM usuarios WHERE nome = :nome LIMIT 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 5. Se o usuário existir, valida a senha criptografada
        if ($usuario && password_verify($senha_pura, $usuario['senha'])) {
            
            // Cria as variáveis de sessão para permitir que você entre nas outras páginas
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nome_usuario'] = $usuario['nome'];
            $_SESSION['usuario_logado'] = true;

            //Redireciona para o painel principal de produtos ou de leitura
            header("Location: produtos_read.php");
            exit();
        } else {
            // Senha incorreta ou usuário inexistente
            header("Location: index.php?erro=usuario_ou_senha_incorretos");
            exit();
        }

    } catch (PDOException $e) {
        echo "<h3>Erro ao processar o login:</h3>" . $e->getMessage();
        exit();
    }

} else {
    // Se tentarem acessar o arquivo direto pela URL, manda de volta para o login
    header("Location: index.php");
    exit();
}
?>