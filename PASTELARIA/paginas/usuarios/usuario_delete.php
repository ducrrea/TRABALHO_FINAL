<?php
session_start();
require_once "../conexao_bd.php";

$id_usuario = "";
$nome_usuario = "";
$erro = "";

// 1. CAPTURA O ID: Verifica se veio algo do read (via GET) ou se você digitou e deu Enter (via POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_usuario = trim($_POST['id']);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_usuario = trim($_GET['id']);
}

// 2. BUSCA NO BANCO: Se tiver um ID e NÃO for uma confirmação de deletar de fato, busca o nome
if (!empty($id_usuario) && !isset($_POST['confirmar_deletar'])) {
    $sql = "SELECT nome FROM usuarios WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        $nome_usuario = $usuario['nome'];
    } else {
        $erro = "Funcionário não encontrado!";
        $id_usuario = ""; // Reseta o ID para o campo ficar limpo para nova busca
    }
}
?>
<!DOCTYPE html><html class="light" lang="pt-BR"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Revogar Acesso | L'Art du Pastel</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&amp;family=DM+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#775a19",
                    "primary-container": "#c5a059",
                    "on-primary-container": "#4e3700",
                    "surface": "#fbf9f1",
                    "on-surface": "#1b1c17",
                    "on-surface-variant": "#4e4639",
                    "outline": "#7f7667",
                    "outline-variant": "#d1c5b4",
                    "surface-container-low": "#f5f4ec",
                    "surface-container": "#f0eee6",
                    "surface-container-high": "#eae8e0",
                    "surface-container-highest": "#e4e3db",
                    "background": "#fbf9f1",
                    "error": "#ba1a1a",
                    "on-error": "#ffffff"
            },
            "fontFamily": {
              "display": ["Playfair Display", "serif"],
              "sans": ["DM Sans", "sans-serif"]
            },
            "spacing": {
              "margin-desktop": "40px",
              "margin-mobile": "20px",
              "stack-sm": "12px",
              "stack-md": "24px",
              "stack-lg": "48px",
              "gutter": "24px"
            }
          }
        }
      }
    </script>
<style>
        body {
            background-color: #FFFDF5;
            overflow-x: hidden;
        }
        .minimal-shadow {
            box-shadow: 0 4px 20px rgba(119, 90, 25, 0.05);
        }
        .glass-header {
            background: rgba(255, 253, 245, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="font-sans text-on-surface bg-background min-h-screen flex flex-col justify-between selection:bg-primary/10">

<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-stack-sm glass-header border-b border-outline-variant/20">
    <a class="flex items-center gap-2 text-primary hover:opacity-80 transition-all duration-200" href="usuario_read.php">
        <span class="material-symbols-outlined text-[28px]">arrow_back</span>
        <span class="font-sans font-medium text-body-md hidden sm:inline">Voltar à Listagem</span>
    </a>
    <div class="font-display font-bold text-headline-md text-primary tracking-tight">L'Art du Pastel</div>
    <div class="w-10"></div>
</header>

<main class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop pt-[100px] pb-stack-lg flex flex-col gap-stack-lg my-auto flex-grow justify-center">
    
    <header class="flex flex-col gap-2 max-w-2xl">
        <span class="font-sans font-bold text-label-sm uppercase tracking-[0.2em] text-primary/60">Segurança do Ateliê</span>
        <h1 class="font-display font-bold text-[32px] md:text-[44px] text-primary leading-tight">Remover Artesão</h1>
        <p class="text-on-surface-variant font-normal text-body-md opacity-90">Insira o ID numérico do usuário para localizá-lo e revogar definitivamente suas credenciais de acesso.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
        
        <div class="lg:col-span-7 w-full hidden md:block">
            <div class="relative w-full aspect-[16/10] rounded-3xl overflow-hidden shadow-xl group">
                <img alt="Ateliê Pastelaria" class="w-full h-full object-cover transition-transform duration-[6000ms]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnTRQ5ali4jACIjt7YzxiNZnHVSQ5uoCI2RltrwlagYfHPlwYxceAIZD8hIKt3SykHzcnr_92qCHianXCMm55q9cFw_WMmP7P9oRJf8JVEbrmzU-S-m3kru8IvmsEcP0p4j3zS5_URhgEkg1wEHM62MxMmPjk2BLMXqWOrssv6-U_1Pw-B-w-CkuW7VsEfm_8Y5phrngfbDSM9Dc0Palbm7VksUM5QHpJS4Tkev5Bo-jbdgN7Taln-Dl1bTwn-EgcNB9GQqAFuHEE">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-primary/15 to-transparent flex items-end p-8">
                    <p class="font-display italic text-white text-body-lg opacity-95">"A segurança do nosso ateliê garante a integridade de nossas receitas tradicionais."</p>
                </div>
            </div>
        </div>

        <section class="lg:col-span-5 w-full">
            <div class="w-full bg-surface border border-outline-variant/30 rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden">
                <header class="mb-6 flex flex-col gap-2">
                    <div class="w-10 h-10 rounded-xl bg-error/10 text-error flex items-center justify-center border border-error/20">
                        <span class="material-symbols-outlined text-[22px]">person_remove</span>
                    </div>
                    <div>
                        <h2 class="font-display font-bold text-[24px] text-primary mb-1">Confirmar Exclusão</h2>
                        <p class="text-on-surface-variant text-body-sm opacity-80">Esta ação é permanente e removerá o funcionário da listagem.</p>
                    </div>
                </header>

                <form id="form-delete" action="usuario_delete.php" method="POST" class="flex flex-col gap-5">
                    
                    <div class="flex flex-col gap-2">
                        <label class="font-sans font-semibold text-[12px] uppercase tracking-wider text-primary" for="id">ID de Registro</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-[20px]">fingerprint</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-sans text-body-medium placeholder:text-outline/40" 
                                   id="id" name="id" placeholder="Digite o ID e aperte Enter" required type="text" autocomplete="off"
                                   value="<?php echo htmlspecialchars($id_usuario); ?>" <?php echo !empty($nome_usuario) ? 'readonly' : ''; ?>>
                        </div>
                        <?php if (!empty($erro)): ?>
                            <span class="text-error text-xs mt-1 font-medium"><?php echo $erro; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-2 <?php echo empty($nome_usuario) ? 'opacity-50' : ''; ?>">
                        <label class="font-sans font-semibold text-[12px] uppercase tracking-wider text-primary" for="nome">Nome do Artesão</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-[20px]">badge</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-outline-variant/20 rounded-xl font-sans text-body-medium text-on-surface-variant" 
                                   id="nome" name="nome" placeholder="Aparecerá automaticamente" readonly type="text"
                                   value="<?php echo htmlspecialchars($nome_usuario); ?>">
                        </div>
                    </div>

                    <div class="pt-2">
                        <?php if (!empty($nome_usuario)): ?>
                            <input type="hidden" name="confirmar_deletar" value="1">
                            <button type="submit" onclick="fazerExclusaoReal(event)" class="w-full bg-error text-white font-sans font-semibold py-4 rounded-xl shadow-lg hover:bg-error/95 transition-all duration-300 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">delete_forever</span>
                                Confirmar Exclusão Permanente
                            </button>
                            <div class="text-center mt-3">
                                <a href="usuario_delete.php" class="text-[12px] text-primary hover:underline font-medium">Buscar outro ID</a>
                            </div>
                        <?php else: ?>
                            <button type="submit" class="w-full bg-surface-container-high text-outline font-sans font-semibold py-4 rounded-xl border border-outline-variant/30 flex items-center justify-center gap-2 opacity-80 cursor-pointer">
                                <span class="material-symbols-outlined text-[20px]">keyboard_return</span>
                                Aperte Enter para buscar
                            </button>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="mt-6 pt-4 border-t border-outline-variant/20 flex justify-between items-center opacity-40">
                    <div class="flex gap-1.5">
                        <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-primary/40"></div>
                    </div>
                    <span class="font-sans text-[9px] tracking-[0.2em] uppercase font-bold">Sécurité Ateliê</span>
                </div>
            </div>
        </section>
    </div>
</main>

<footer class="w-full py-6 flex justify-center items-center bg-transparent opacity-40">
    <p class="font-sans text-[11px] tracking-widest uppercase">L'Art du Pastel © 2026</p>
</footer>

<script>
    // Função JavaScript que muda o destino do formulário para o arquivo de validação na hora de deletar
    function fazerExclusaoReal(event) {
        const form = document.getElementById('form-delete');
        form.action = 'validar_delete_usuario.php';
        
        // Efeito visual de carregamento no botão
        const btn = event.currentTarget;
        btn.innerHTML = '<span class="flex items-center justify-center gap-2"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span> Excluindo...</span>';
        btn.style.opacity = '0.9';
        btn.style.pointerEvents = 'none';
        
        form.submit();
    }
</script>
</body></html>