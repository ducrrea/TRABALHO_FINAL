<?php
session_start();
require_once "../conexao_bd.php";

// Busca todos os usuários para listar no carrossel superior
$sql = "SELECT id, nome FROM usuarios ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html><html class="light" lang="pt-BR" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Gerenciar Usuários | L'Art du Pastel</title>
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
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
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
        <span class="font-sans font-bold text-label-sm uppercase tracking-[0.2em] text-primary/60">Painel de Controle</span>
        <h1 class="font-display font-bold text-[32px] md:text-[44px] text-primary leading-tight">Gerenciar Usuários</h1>
        <p class="text-on-surface-variant font-normal text-body-md opacity-90">Selecione um perfil cadastrado para atualizar credenciais de acesso ou modificar permissões operacionais.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        
        <div class="lg:col-span-7 flex flex-col gap-6 w-full overflow-hidden">
            <div class="flex justify-between items-center px-1">
                <h3 class="font-sans font-semibold text-body-lg text-primary">Usuários Cadastrados</h3>
                <div class="flex gap-2">
                    <button onclick="scrollCarrossel(-200)" class="w-9 h-9 rounded-full border border-outline-variant/40 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300 active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </button>
                    <button onclick="scrollCarrossel(200)" class="w-9 h-9 rounded-full border border-outline-variant/40 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300 active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </button>
                </div>
            </div>

            <div id="carrossel-usuarios" class="flex gap-4 overflow-x-auto no-scrollbar snap-x snap-mandatory scroll-smooth pb-4 px-1">
                <?php if (empty($usuarios)): ?>
                    <p class="text-on-surface-variant p-4">Nenhum usuário cadastrado.</p>
                <?php else: ?>
                    <?php foreach ($usuarios as $usr): ?>
                        <button type="button" onclick="selecionarUsuario(<?= $usr['id'] ?>, '<?= htmlspecialchars($usr['nome'], ENT_QUOTES, 'UTF-8') ?>')" class="snap-start shrink-0 text-left focus:outline-none group/card">
                            <div class="w-[180px] bg-surface border border-outline-variant/20 rounded-2xl p-5 flex flex-col gap-4 transition-all duration-300 minimal-shadow group-hover/card:-translate-y-1 group-hover/card:shadow-md cursor-pointer border-outline-variant/20">
                                <div class="w-12 h-12 rounded-xl bg-surface-container text-on-surface-variant/40 flex items-center justify-center transition-colors duration-300">
                                    <span class="material-symbols-outlined text-[24px]">person</span>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <h4 class="font-sans font-bold text-body-md text-primary truncate"><?= htmlspecialchars($usr['nome']) ?></h4>
                                    <span class="font-sans text-[12px] text-on-surface-variant opacity-70">ID: #<?= str_pad($usr['id'], 3, '0', STR_PAD_LEFT) ?></span>
                                </div>
                            </div>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="relative w-full aspect-[21/9] rounded-3xl overflow-hidden shadow-xl hidden md:block group">
                <img alt="Ateliê Pastelaria" class="w-full h-full object-cover transition-transform duration-[6000ms] group-hover:scale-105" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3bPiQgn46KyZ7P7zFN5Pt_FA4snydI877WMkA5XEAkw&s=10">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent flex items-end p-6">
                    <p class="font-display italic text-white text-body-lg opacity-90">"La tradition rencontre la modernité dans chaque détail."</p>
                </div>
            </div>
        </div>

        <section class="lg:col-span-5 w-full">
            <div class="w-full bg-surface border border-outline-variant/30 rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden">
                <header class="mb-6">
                    <h2 class="font-display font-bold text-[24px] text-primary mb-1">Modificar Credenciais</h2>
                    <p class="text-on-surface-variant text-body-sm opacity-80">Altere o nome identificador ou defina uma nova chave de acesso segura.</p>
                </header>

                <form id="form-update" action="validar_update_usuario.php" method="POST" class="flex flex-col gap-5">
                    <input type="hidden" id="input-id" name="id" value="">

                    <div class="flex flex-col gap-2">
                        <label class="font-sans font-semibold text-[12px] uppercase tracking-wider text-primary" for="nome">Nome do Usuário</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-[20px]">badge</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-sans text-body-medium" id="input-nome" name="nome" placeholder="Selecione um usuário acima" required type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="font-sans font-semibold text-[12px] uppercase tracking-wider text-primary" for="senha">Nova Senha de Acesso</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-outline text-[20px]">lock</span>
                            <input class="w-full pl-12 pr-12 py-3.5 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-sans text-body-medium" id="input-senha" name="senha" placeholder="Digite a nova senha" required type="password">
                            <button class="absolute right-4 text-outline hover:text-primary transition-colors flex items-center justify-center" onclick="togglePasswordVisibility()" type="button">
                                <span class="material-symbols-outlined text-[20px]" id="eye-icon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white font-sans font-semibold py-4 rounded-xl shadow-lg hover:bg-primary/95 hover:shadow-primary/20 transition-all duration-300 flex items-center justify-center gap-2 mt-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Salvar Alterações
                    </button>
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
    // Função para andar/rolar o carrossel usando as setas
    function scrollCarrossel(distancia) {
        document.getElementById('carrossel-usuarios').scrollBy({ left: distancia, behavior: 'smooth' });
    }

    // Função executada ao clicar em um cartão de usuário lá em cima
    function selecionarUsuario(id, nome) {
        // Alimenta os campos do formulário do lado direito
        document.getElementById('input-id').value = id;
        document.getElementById('input-nome').value = nome;
        document.getElementById('input-senha').value = ''; // Mantém limpo para digitar a nova senha
        document.getElementById('input-senha').focus();

        // Remove a borda de destaque ativa de todos os cartões anteriores
        const todosOsCards = document.querySelectorAll('#carrossel-usuarios button div');
        todosOsCards.forEach(c => {
            c.classList.remove('border-primary', 'ring-4', 'ring-primary/5');
            c.classList.add('border-outline-variant/20');
            c.querySelector('.w-12').classList.remove('bg-primary/10', 'text-primary');
            c.querySelector('.w-12').classList.add('bg-surface-container', 'text-on-surface-variant/40');
        });

        // Adiciona destaque visual no cartão selecionado (mantendo suas classes originais)
        const cardClicado = event.currentTarget.querySelector('div');
        cardClicado.classList.remove('border-outline-variant/20');
        cardClicado.classList.add('border-primary', 'ring-4', 'ring-primary/5');
        const iconBox = cardClicado.querySelector('.w-12');
        iconBox.classList.remove('bg-surface-container', 'text-on-surface-variant/40');
        iconBox.classList.add('bg-primary/10', 'text-primary');
    }

    // Controle de visualização de senha
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('input-senha');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerText = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerText = 'visibility';
        }
    }
</script>
</body></html>