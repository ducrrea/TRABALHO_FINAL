<!DOCTYPE html><html class="light" lang="pt-BR"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>L'Art du Pastel - Dashboard</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=DM+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-dim": "#dcdad2",
                        "surface-container": "#f0eee6",
                        "tertiary-fixed-dim": "#dcc497",
                        "tertiary-fixed": "#f9dfb1",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#554422",
                        "on-background": "#1b1c17",
                        "on-surface-variant": "#4e4639",
                        "error": "#ba1a1a",
                        "inverse-surface": "#30312c",
                        "on-tertiary": "#ffffff",
                        "secondary": "#795553",
                        "on-secondary-fixed-variant": "#5f3e3c",
                        "inverse-primary": "#e9c176",
                        "on-secondary-fixed": "#2e1413",
                        "surface-variant": "#e4e3db",
                        "primary-fixed": "#ffdea5",
                        "surface-container-low": "#f5f4ec",
                        "surface-tint": "#775a19",
                        "on-secondary": "#ffffff",
                        "secondary-fixed": "#ffdad7",
                        "tertiary": "#6e5c37",
                        "on-error-container": "#93000a",
                        "primary-fixed-dim": "#e9c176",
                        "outline": "#7f7667",
                        "inverse-on-surface": "#f3f1e9",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-container": "#493918",
                        "primary": "#775a19",
                        "surface-container-high": "#eae8e0",
                        "surface-container-highest": "#e4e3db",
                        "on-error": "#ffffff",
                        "surface": "#fbf9f1",
                        "secondary-container": "#ffcfcb",
                        "on-secondary-container": "#7a5653",
                        "on-primary-fixed-variant": "#5d4201",
                        "on-primary-container": "#4e3700",
                        "on-tertiary-fixed": "#261a00",
                        "on-surface": "#1b1c17",
                        "background": "#fbf9f1",
                        "primary-container": "#c5a059",
                        "on-primary": "#ffffff",
                        "secondary-fixed-dim": "#eabcb8",
                        "outline-variant": "#d1c5b4",
                        "tertiary-container": "#b9a379",
                        "surface-bright": "#fbf9f1",
                        "on-primary-fixed": "#261900"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "stack-md": "24px",
                        "margin-desktop": "40px",
                        "stack-lg": "48px",
                        "unit": "8px",
                        "stack-sm": "12px",
                        "gutter": "24px",
                        "container-max": "1200px"
                    },
                    "fontFamily": {
                        "display-lg": ["Playfair Display"],
                        "label-sm": ["DM Sans"],
                        "headline-md": ["Playfair Display"],
                        "body-md": ["DM Sans"],
                        "display-lg-mobile": ["Playfair Display"],
                        "button": ["DM Sans"],
                        "body-lg": ["DM Sans"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 20px 40px rgba(140, 120, 81, 0.15);
        }
        .bg-overlay {
            background: linear-gradient(rgba(27, 28, 23, 0.4), rgba(27, 28, 23, 0.4));
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md selection:bg-primary-container selection:text-on-primary-container min-h-screen flex flex-col">
<!-- TopAppBar Shell -->
<header class="fixed top-0 left-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-white/30 shadow-[0_10px_30px_-15px_rgba(140,120,81,0.15)]">
<div class="flex items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto justify-center">
<h1 class="font-display-lg text-display-lg tracking-tight text-primary">L'Art du Pastel</h1>


</div>
</header>
<!-- Hero Content Canvas -->
<main class="flex-grow pt-20 relative min-h-[90vh] flex items-center justify-center overflow-hidden">
<!-- Background with Overlay -->
<div class="absolute inset-0 z-0">
<div class="absolute inset-0 bg-overlay z-10"></div>
<img alt="Pastéis gourmet" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida/AP1WRLu6RIp_DTmurNrIiuVCdfRx_By__NWlt52_4N_AJC8y3e8nPq1Z1CODxjhqQuTdycCwsxfHwYtM_OsoMA88zn2w0nm6qPWruC4SteMzXOYXkx3OOOPfCeACERh6NPjeXUu_8oToEBACcFrNhNDscIPV4-lTaaZU4MJQqLiz3cXjOEngIYVJzHo-TjrFNADcGGBGa0tGOC9sKTnlqHozQVtsAtT-n9k6ccxuQnDsqlGxoYf8eRasEq0FptI">
</div>
<!-- Dashboard Grid -->
<div class="relative z-20 w-full max-w-container-max px-margin-mobile md:px-margin-desktop py-stack-lg">
<div class="text-center mb-stack-lg text-white">
<h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg mb-2">Painel Executivo</h2>

</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
<!-- Usuários Card -->
<form action="validar_usuario.php" class="glass-card rounded-xl p-stack-md flex flex-col items-center text-center cursor-pointer group focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" method="POST" onclick="this.submit()" tabindex="0">
<div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-stack-sm text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
<span class="material-symbols-outlined text-[32px]" data-icon="person">person</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Usuários</h3>
<p class="font-label-sm text-label-sm text-on-surface-variant">Gestão de acessos e permissões administrativas.</p>
<input name="context" type="hidden" value="dashboard_access">
</form>
<!-- Clientes Card -->
<form action="validar_cliente.php" class="glass-card rounded-xl p-stack-md flex flex-col items-center text-center cursor-pointer group focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" method="POST" onclick="this.submit()" tabindex="0">
<div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-stack-sm text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
<span class="material-symbols-outlined text-[32px]" data-icon="group">group</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Clientes</h3>
<p class="font-label-sm text-label-sm text-on-surface-variant">Base de dados e fidelidade epicurista.</p>
<input name="context" type="hidden" value="client_management">
</form>
<!-- Produtos Card -->
<form action="validar_produtos.php" class="glass-card rounded-xl p-stack-md flex flex-col items-center text-center cursor-pointer group focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" method="POST" onclick="this.submit()" tabindex="0">
<div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-stack-sm text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
<span class="material-symbols-outlined text-[32px]" data-icon="restaurant_menu">restaurant_menu</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Produtos</h3>
<p class="font-label-sm text-label-sm text-on-surface-variant">Catálogo de massas e recheios artesanais.</p>
<input name="context" type="hidden" value="catalog_edit">
</form>
<!-- Pedidos Card -->
<form action="validar_pedidos.php" class="glass-card rounded-xl p-stack-md flex flex-col items-center text-center cursor-pointer group focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" method="POST" onclick="this.submit()" tabindex="0">
<div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-stack-sm text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
<span class="material-symbols-outlined text-[32px]" data-icon="receipt_long">receipt_long</span>
</div>
<h3 class="font-headline-md text-headline-md text-primary mb-2">Pedidos</h3>
<p class="font-label-sm text-label-sm text-on-surface-variant">Controle de fluxo e entregas gourmet.</p>
<input name="context" type="hidden" value="order_tracking">
</form>
</div>
</div>
</main>
<!-- Footer Shell -->

<script>
        // Micro-interactions and accessibility
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    form.submit();
                }
            });
            // Focus outline for accessibility
            form.setAttribute('tabindex', '0');
            form.classList.add('focus:outline-none', 'focus:ring-2', 'focus:ring-primary', 'focus:ring-offset-2');
        });
    </script>


</body></html>