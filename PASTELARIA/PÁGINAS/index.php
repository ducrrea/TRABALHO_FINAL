<!DOCTYPE html>

<html class="light" lang="pt-br"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>L'Art du Pastel - Painel Executivo</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=DM+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary": "#795553",
                    "on-tertiary-container": "#493918",
                    "secondary-fixed-dim": "#eabcb8",
                    "on-surface": "#1b1c17",
                    "on-primary-container": "#4e3700",
                    "on-primary-fixed": "#261900",
                    "on-tertiary-fixed": "#261a00",
                    "on-secondary-fixed": "#2e1413",
                    "error-container": "#ffdad6",
                    "primary-fixed": "#ffdea5",
                    "primary": "#775a19",
                    "on-secondary-fixed-variant": "#5f3e3c",
                    "tertiary-fixed": "#f9dfb1",
                    "on-primary": "#ffffff",
                    "on-tertiary-fixed-variant": "#554422",
                    "tertiary-container": "#b9a379",
                    "surface-container": "#f0eee6",
                    "secondary-fixed": "#ffdad7",
                    "surface-variant": "#e4e3db",
                    "tertiary-fixed-dim": "#dcc497",
                    "surface-container-high": "#eae8e0",
                    "inverse-surface": "#30312c",
                    "primary-container": "#c5a059",
                    "surface": "#fbf9f1",
                    "secondary-container": "#ffcfcb",
                    "primary-fixed-dim": "#e9c176",
                    "surface-tint": "#775a19",
                    "on-error-container": "#93000a",
                    "outline-variant": "#d1c5b4",
                    "inverse-on-surface": "#f3f1e9",
                    "surface-container-highest": "#e4e3db",
                    "surface-dim": "#dcdad2",
                    "surface-container-low": "#f5f4ec",
                    "surface-bright": "#fbf9f1",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#4e4639",
                    "surface-container-lowest": "#ffffff",
                    "error": "#ba1a1a",
                    "inverse-primary": "#e9c176",
                    "background": "#fbf9f1",
                    "on-secondary": "#ffffff",
                    "outline": "#7f7667",
                    "on-secondary-container": "#7a5653",
                    "on-background": "#1b1c17",
                    "tertiary": "#6e5c37",
                    "on-error": "#ffffff",
                    "on-primary-fixed-variant": "#5d4201"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "stack-lg": "48px",
                    "unit": "8px",
                    "stack-sm": "12px",
                    "margin-mobile": "20px",
                    "margin-desktop": "40px",
                    "container-max": "1200px",
                    "gutter": "24px",
                    "stack-md": "24px"
            },
            "fontFamily": {
                    "display-lg-mobile": ["Playfair Display"],
                    "label-sm": ["DM Sans"],
                    "display-lg": ["Playfair Display"],
                    "button": ["DM Sans"],
                    "body-md": ["DM Sans"],
                    "body-lg": ["DM Sans"],
                    "headline-md": ["Playfair Display"]
            },
            "fontSize": {
                    "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "label-sm": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}],
                    "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-panel {
            background: rgba(255, 253, 245, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 40px rgba(140, 120, 81, 0.08);
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(197, 160, 89, 0.2);
        }
        body {
            background-color: #FFFDF5;
        }
        .hero-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: linear-gradient(rgba(251, 249, 241, 0.85), rgba(251, 249, 241, 0.85)), url('https://lh3.googleusercontent.com/aida/AP1WRLuvdbWVHfLVmpQ11T1EUuNKIIc-FaspOcyDPv5Wf95DqKz_P1w8tL6k-mYH-3LHx1iiJ5ZFAFAXaO3kjGU1HG3LScnW14rShlKlOJonlLRgWdsr7J_GcqsDwH4YrOij78Aln7IwI_T4nhFx6lXWsYvssaKhPDQFvspu71i2ImGTBoZcxKO_8kRgt-1N3uRXvy0Rzwr_Zz-gu-NhVKfELjIUz-BhKsjM8nS6rHD4ZsLBTEK67AsjCvOYHA4');
            background-size: cover;
            background-position: center;
            filter: grayscale(10%) contrast(105%);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(140, 120, 81, 0.15);
        }
    </style>
</head>
<body class="min-h-screen text-on-surface font-body-md overflow-x-hidden">
<div class="hero-bg"></div>
<!-- Header (TopAppBar) -->
<header class="fixed top-0 left-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-white/30 shadow-[0_10px_30px_-15px_rgba(140,120,81,0.15)] h-20">
<div class="flex justify-center items-center h-full px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
<h1 class="font-display-lg text-[28px] md:text-display-lg tracking-tight text-primary">L'Art du Pastel</h1>
</div>
</header>
<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
<!-- Executive Title Section -->
<section class="mb-stack-lg relative">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="max-w-2xl">
<span class="font-label-sm text-label-sm text-primary uppercase tracking-[0.2em] mb-4 block">Dashboard de Gestão</span>
<h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface leading-none">Painel Executivo</h2>
<div class="h-px w-32 bg-primary-container mt-6"></div>
</div>
<div class="text-right hidden md:block">
<p class="font-label-sm text-label-sm text-on-surface-variant italic">Refinando a excelência em cada detalhe.</p>
</div>
</div>
</section>
<!-- Asymmetrical Dashboard Layout -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-start">
<!-- Usuários (Large Vertical Focus) -->
<div class="md:col-span-4 h-full">
<form action="validar_usuario.php" class="glass-panel p-stack-md rounded-xl card-hover transition-all duration-500 h-full flex flex-col group" method="POST">
<div class="mb-stack-lg">
<div class="flex justify-between items-start mb-6">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="account_circle">account_circle</span>
<span class="font-label-sm text-label-sm text-outline">01</span>
</div>
<h3 class="font-headline-md text-headline-md text-secondary mb-2">Usuários</h3>
<p class="font-body-md text-on-surface-variant text-sm">Gerencie acessos e permissões administrativas da plataforma.</p>
</div>
<div class="mt-auto pt-8 border-t border-outline-variant/30 flex justify-between items-center">
<button class="font-button text-button text-primary flex items-center gap-2 group-hover:gap-4 transition-all" type="submit">
                            ACESSAR GESTÃO <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</form>
</div>
<!-- Clientes (Landscape Focus) -->
<div class="md:col-span-8">
<form action="validar_cliente.php" class="glass-panel p-stack-md rounded-xl card-hover transition-all duration-500 group relative overflow-hidden" method="POST">
<div class="relative z-10">
<div class="flex justify-between items-start mb-10">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="loyalty">loyalty</span>
<span class="font-label-sm text-label-sm text-outline">02</span>
</div>
<div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
<div class="max-w-md">
<h3 class="font-headline-md text-headline-md text-secondary mb-2">Clientes</h3>
<p class="font-body-md text-on-surface-variant">Visualize o histórico, preferências e fidelidade dos apreciadores da marca.</p>
</div>
<button class="font-button text-button bg-primary text-on-primary px-8 py-4 rounded-full shadow-lg hover:shadow-primary/20 transition-all active:scale-95" type="submit">
                                Ver Carteira
                            </button>
</div>
</div>
<!-- Subtle decorative line -->
<div class="absolute -right-4 -bottom-4 opacity-5 pointer-events-none">
<span class="material-symbols-outlined text-[120px]" data-icon="groups">groups</span>
</div>
</form>
<!-- Nested Grid for Pedidos & Produtos -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter mt-gutter">
<!-- Produtos -->
<form action="validar_produtos.php" class="glass-panel p-stack-md rounded-xl card-hover transition-all duration-500 group" method="POST">
<div class="mb-10">
<div class="flex justify-between items-start mb-6">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="restaurant_menu">restaurant_menu</span>
<span class="font-label-sm text-label-sm text-outline">03</span>
</div>
<h3 class="font-headline-md text-headline-md text-secondary mb-2">Produtos</h3>
<p class="font-body-md text-on-surface-variant text-sm">Controle de estoque, novos sabores e fichas técnicas artesanais.</p>
</div>
<button class="w-full py-3 border border-primary text-primary font-button text-button rounded-lg hover:bg-primary hover:text-on-primary transition-colors" type="submit">
                            Inventário
                        </button>
</form>
<!-- Pedidos -->
<form action="validar_pedidos.php" class="glass-panel p-stack-md rounded-xl card-hover transition-all duration-500 group border-l-4 border-l-primary-container" method="POST">
<div class="mb-10">
<div class="flex justify-between items-start mb-6">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="receipt_long">receipt_long</span>
<span class="font-label-sm text-label-sm text-outline">04</span>
</div>
<h3 class="font-headline-md text-headline-md text-secondary mb-2">Pedidos</h3>
<p class="font-body-md text-on-surface-variant text-sm">Monitoramento em tempo real do fluxo de produção e entregas.</p>
</div>
<button class="w-full py-3 bg-secondary text-white font-button text-button rounded-lg hover:bg-on-secondary-fixed-variant transition-colors flex items-center justify-center gap-2" type="submit">
                            Acompanhar <span class="material-symbols-outlined text-sm" data-icon="near_me">near_me</span>
</button>
</form>
</div>
</div>
</div>
<!-- Decorative Elements -->
<div class="mt-24 flex flex-col items-center opacity-40">
<div class="h-px w-full max-w-xl bg-gradient-to-r from-transparent via-outline-variant to-transparent mb-8"></div>
<p class="font-label-sm text-label-sm tracking-[0.3em] text-outline text-center">L'ART DU PASTEL © MMXXIV</p>
</div>
</main>
<!-- Micro-interaction Script -->
<script>
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', () => {
                const icon = card.querySelector('.material-symbols-outlined');
                if(icon) {
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                    icon.style.transition = 'transform 0.3s ease';
                }
            });
            card.addEventListener('mouseleave', () => {
                const icon = card.querySelector('.material-symbols-outlined');
                if(icon) {
                    icon.style.transform = 'scale(1) rotate(0deg)';
                }
            });
        });
    </script>
</body></html>