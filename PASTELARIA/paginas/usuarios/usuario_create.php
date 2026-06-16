<!DOCTYPE html><html class="scroll-smooth" lang="pt-BR" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>L'Art du Pastel - Cadastrar Usuário</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed": "#2e1413",
                        "on-tertiary-container": "#493918",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f5f4ec",
                        "outline-variant": "#d1c5b4",
                        "primary-fixed-dim": "#e9c176",
                        "on-tertiary": "#ffffff",
                        "primary": "#775a19",
                        "on-primary-container": "#4e3700",
                        "background": "#fbf9f1",
                        "inverse-primary": "#e9c176",
                        "tertiary-fixed-dim": "#dcc497",
                        "on-secondary-container": "#7a5653",
                        "inverse-on-surface": "#f3f1e9",
                        "on-secondary-fixed-variant": "#5f3e3c",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#eabcb8",
                        "secondary-fixed": "#ffdad7",
                        "on-surface": "#1b1c17",
                        "tertiary-container": "#b9a379",
                        "inverse-surface": "#30312c",
                        "outline": "#7f7667",
                        "on-secondary": "#ffffff",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#e4e3db",
                        "surface-container-high": "#eae8e0",
                        "surface": "#fbf9f1",
                        "secondary-container": "#ffcfcb",
                        "error-container": "#ffdad6",
                        "on-primary-fixed": "#261900",
                        "on-primary-fixed-variant": "#5d4201",
                        "secondary": "#795553",
                        "on-error": "#ffffff",
                        "primary-container": "#c5a059",
                        "tertiary": "#6e5c37",
                        "surface-container": "#f0eee6",
                        "on-background": "#1b1c17",
                        "on-surface-variant": "#4e4639",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e4e3db",
                        "surface-bright": "#fbf9f1",
                        "on-tertiary-fixed": "#261a00",
                        "surface-tint": "#775a19",
                        "on-tertiary-fixed-variant": "#554422",
                        "primary-fixed": "#ffdea5",
                        "tertiary-fixed": "#f9dfb1",
                        "surface-dim": "#dcdad2"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-desktop": "40px",
                        "margin-mobile": "20px",
                        "unit": "8px",
                        "stack-md": "24px",
                        "stack-sm": "12px",
                        "stack-lg": "48px",
                        "gutter": "24px",
                        "container-max": "1200px"
                    },
                    "fontFamily": {
                        "headline-md": ["Playfair Display"],
                        "body-md": ["DM Sans"],
                        "button": ["DM Sans"],
                        "body-lg": ["DM Sans"],
                        "display-lg-mobile": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "label-sm": ["DM Sans"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}]
                    }
                },
            },
        }
    </script>
<style>
        body {
            background-color: #FFFDF5; /* Clotted Cream */
            overflow-x: hidden;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-left: 1px solid rgba(255, 255, 255, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(140, 120, 81, 0.12); /* Roasted Bronze tint */
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .floating-label-input:focus-within label,
        .floating-label-input input:not(:placeholder-shown) + label {
            transform: translateY(-24px) scale(0.85);
            color: #775a19;
        }

        /* Asymmetric organic mask */
        .hero-mask {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }

        @media (min-width: 768px) {
            .hero-mask {
                clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
            }
        }
    </style>
</head>
<body class="font-body-md text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
<header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-margin-mobile md:px-margin-desktop py-stack-sm bg-transparent">
<a class="flex items-center gap-2 text-primary hover:opacity-80 transition-opacity active:scale-95 duration-200" href="usuario_read.php">
<span class="material-symbols-outlined text-display-lg-mobile md:text-display-lg">arrow_back</span>
</a>
<div class="font-display-lg text-headline-md text-primary dark:text-primary-fixed-dim tracking-tight">
            L'Art du Pastel
        </div>
<div class="w-10"></div> </header>
<main class="min-h-screen relative flex flex-col md:flex-row overflow-hidden h-screen">
<section class="relative w-full md:w-3/5 h-[40vh] md:h-screen hero-mask overflow-hidden order-1 md:order-2 h-screen">
<img alt="Gourmet Pastel" class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-[10000ms] hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnTRQ5ali4jACIjt7YzxiNZnHVSQ5uoCI2RltrwlagYfHPlwYxceAIZD8hIKt3SykHzcnr_92qCHianXCMm55q9cFw_WMmP7P9oRJf8JVEbrmzU-S-m3kru8IvmsEcP0p4j3zS5_URhgEkg1wEHM62MxMmPjk2BLMXqWOrssv6-U_1Pw-B-w-CkuW7VsEfm_8Y5phrngfbDSM9Dc0Palbm7VksUM5QHpJS4Tkev5Bo-jbdgN7Taln-Dl1bTwn-EgcNB9GQqAFuHEE" style="transform: scale(1.1) translate(3.34px, 4.95px);"/>
<div class="absolute inset-0 bg-gradient-to-t from-background/40 to-transparent"></div>
<div class="absolute inset-0 bg-gradient-to-r from-background via-transparent to-transparent md:block hidden"></div>
<div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary/20 blur-[100px] rounded-full"></div>
</section>
<section class="w-full md:w-2/5 flex items-center justify-center p-margin-mobile md:p-margin-desktop z-10 order-2 md:order-1 relative">
<div class="w-full max-w-md glass-panel p-stack-lg rounded-[2.5rem] relative overflow-hidden transition-all duration-500 hover:shadow-2xl">
<div class="absolute -top-20 -right-20 w-40 h-40 bg-primary-fixed-dim/30 blur-[60px] rounded-full"></div>
<header class="mb-stack-lg text-center md:text-left">
<h1 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-2">Cadastrar Usuário</h1>
<p class="font-body-md text-on-surface-variant opacity-80">Junte-se à nossa experiência gastronômica artesanal.</p>
</header>
<form action="validar_create_usuario.php" class="space-y-stack-md" method="POST">
<div class="relative floating-label-input group">
<input class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-4 pt-6 text-on-surface focus:ring-2 focus:ring-primary/20 transition-all outline-none font-body-md" id="nome" name="nome" placeholder=" " required="" type="text">
<label class="absolute left-4 top-4 text-on-surface-variant transition-all duration-200 pointer-events-none font-label-sm uppercase tracking-widest text-[10px]" for="nome">
                            Nome Completo
                        </label>
<div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-focus-within:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-primary text-body-md">person</span>
</div>
</div>
<div class="relative floating-label-input group">
<input class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-4 pt-6 text-on-surface focus:ring-2 focus:ring-primary/20 transition-all outline-none font-body-md" id="senha" name="senha" placeholder=" " required="" type="password">
<label class="absolute left-4 top-4 text-on-surface-variant transition-all duration-200 pointer-events-none font-label-sm uppercase tracking-widest text-[10px]" for="senha">
                            Senha de Acesso
                        </label>
<button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" onclick="togglePassword()" type="button">
<span class="material-symbols-outlined text-body-md" id="eye-icon">visibility</span>
</button>
</div>
<div class="pt-stack-sm flex flex-col gap-4">
<button class="w-full bg-primary-container text-on-primary-container font-button text-button py-4 rounded-xl shadow-lg hover:shadow-primary-container/30 hover:scale-[1.02] transition-all active:scale-95 duration-200 flex items-center justify-center gap-2 group" type="submit">
<span class="">Finalizar Cadastro</span>
<span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">chevron_right</span>
</button>
<p class="text-center font-label-sm text-outline">
                            Já possui uma account? <a class="text-primary font-bold hover:underline" href="#">Entrar</a>
</p>
</div>
</form>
<div class="mt-stack-lg pt-stack-md border-t border-outline-variant/30 flex justify-between items-center opacity-60">
<div class="flex gap-2">
<div class="w-2 h-2 rounded-full bg-primary/40"></div>
<div class="w-2 h-2 rounded-full bg-primary/20"></div>
</div>
<span class="font-label-sm text-[10px] tracking-[0.2em] uppercase">Excellence Artisanale</span>
</div>
</div>
</section>
</main>
<footer class="w-full py-stack-md flex flex-col md:flex-row justify-center items-center gap-gutter bg-transparent"></footer>
<script>
        function togglePassword() {
            const passwordInput = document.getElementById('senha');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerText = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerText = 'visibility';
            }
        }

        // Lightweight atmospheric effect: Parallax on background image
        window.addEventListener('mousemove', (e) => {
            const image = document.querySelector('img');
            if (window.innerWidth > 768) {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
                image.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
            }
        });
    </script>


</body></html>