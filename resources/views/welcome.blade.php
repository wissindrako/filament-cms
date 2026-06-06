<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMS — Publica contenido sin fricción</title>
        <meta name="description" content="El CMS que te permite crear, gestionar y publicar contenido en minutos. Sin complicaciones técnicas.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
            html { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
            body { background: #FAFAF9; color: #1b1b18; line-height: 1.6; min-height: 100vh; }
            a { color: inherit; text-decoration: none; }

            /* Nav */
            .nav { display: flex; justify-content: space-between; align-items: center; padding: 1.25rem 2rem; max-width: 1100px; margin: 0 auto; }
            .nav-brand { font-weight: 700; font-size: 1.1rem; letter-spacing: -0.02em; }
            .nav-brand span { color: #f53003; }
            .nav-actions { display: flex; gap: 0.75rem; align-items: center; }
            .btn-ghost { padding: 0.4rem 1.1rem; border: 1px solid #d4d4d0; border-radius: 6px; font-size: 0.875rem; font-weight: 500; background: transparent; cursor: pointer; transition: border-color 0.15s; }
            .btn-ghost:hover { border-color: #1b1b18; }
            .btn-primary { padding: 0.4rem 1.1rem; border: 1px solid #1b1b18; border-radius: 6px; font-size: 0.875rem; font-weight: 500; background: #1b1b18; color: #fff; cursor: pointer; transition: background 0.15s; }
            .btn-primary:hover { background: #2d2d28; }

            /* Hero */
            .hero { text-align: center; padding: 5rem 2rem 3.5rem; max-width: 760px; margin: 0 auto; }
            .hero-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: #fff2f2; color: #f53003; font-size: 0.78rem; font-weight: 600; padding: 0.3rem 0.75rem; border-radius: 99px; border: 1px solid #ffd5cc; margin-bottom: 1.5rem; letter-spacing: 0.02em; text-transform: uppercase; }
            .hero-badge::before { content: '●'; font-size: 0.5rem; }
            .hero-title { font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 700; line-height: 1.1; letter-spacing: -0.03em; color: #1b1b18; margin-bottom: 1.25rem; }
            .hero-title em { color: #f53003; font-style: normal; }
            .hero-sub { font-size: 1.1rem; color: #706f6c; max-width: 520px; margin: 0 auto 2.5rem; line-height: 1.65; }
            .hero-cta { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 1.25rem; }
            .btn-cta-primary { display: inline-block; padding: 0.8rem 2rem; background: #f53003; color: #fff; border-radius: 8px; font-size: 1rem; font-weight: 600; border: none; cursor: pointer; transition: background 0.15s, transform 0.1s; }
            .btn-cta-primary:hover { background: #d42800; transform: translateY(-1px); }
            .btn-cta-secondary { display: inline-block; padding: 0.8rem 2rem; background: #fff; color: #1b1b18; border: 1px solid #d4d4d0; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; transition: border-color 0.15s; }
            .btn-cta-secondary:hover { border-color: #1b1b18; }
            .hero-note { font-size: 0.8rem; color: #9b9b97; }

            /* Stats — Social proof */
            .stats { display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap; padding: 2.5rem 2rem; border-top: 1px solid #e8e8e4; border-bottom: 1px solid #e8e8e4; max-width: 900px; margin: 0 auto; }
            .stat { text-align: center; }
            .stat-number { font-size: 1.75rem; font-weight: 700; color: #1b1b18; letter-spacing: -0.03em; }
            .stat-label { font-size: 0.8rem; color: #9b9b97; margin-top: 0.1rem; }

            /* Benefits */
            .section { max-width: 1060px; margin: 0 auto; padding: 5rem 2rem; }
            .section-label { font-size: 0.78rem; font-weight: 600; color: #f53003; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.75rem; text-align: center; }
            .section-title { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; letter-spacing: -0.025em; text-align: center; margin-bottom: 0.75rem; }
            .section-sub { text-align: center; color: #706f6c; max-width: 480px; margin: 0 auto 3.5rem; font-size: 1rem; }
            .benefits-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 1.5rem; }
            .benefit-card { background: #fff; border: 1px solid #e8e8e4; border-radius: 12px; padding: 2rem; transition: box-shadow 0.2s; }
            .benefit-card:hover { box-shadow: 0 4px 24px rgba(0,0,0,0.07); }
            .benefit-icon { width: 2.5rem; height: 2.5rem; background: #fff2f2; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; font-size: 1.2rem; }
            .benefit-title { font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; }
            .benefit-desc { font-size: 0.9rem; color: #706f6c; line-height: 1.6; }

            /* Steps */
            .steps-section { background: #f5f5f3; }
            .steps-section .section-label { color: #f53003; }
            .steps-section .section-title { color: #1b1b18 !important; }
            .steps-section .section-sub { color: #4a4a47 !important; }
            .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; }
            .step { background: #fff; border: 1px solid #e8e8e4; border-radius: 12px; padding: 2rem; }
            .step-number { font-size: 2.5rem; font-weight: 700; color: #f53003; line-height: 1; margin-bottom: 1rem; letter-spacing: -0.04em; }
            .step-title { font-size: 1.05rem; font-weight: 600; margin-bottom: 0.5rem; color: #1b1b18; }
            .step-desc { font-size: 0.9rem; color: #4a4a47; line-height: 1.6; }

            /* Testimonial */
            .testimonial-section { background: #fff; }
            .testimonial-card { background: #FAFAF9; border: 1px solid #e8e8e4; border-radius: 16px; padding: 2.5rem; max-width: 680px; margin: 0 auto; text-align: center; }
            .testimonial-quote { font-size: 1.15rem; color: #1b1b18; line-height: 1.65; font-style: italic; margin-bottom: 1.5rem; }
            .testimonial-author { display: flex; align-items: center; justify-content: center; gap: 0.75rem; }
            .testimonial-avatar { width: 2.5rem; height: 2.5rem; background: #f53003; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem; }
            .testimonial-name { font-weight: 600; font-size: 0.9rem; }
            .testimonial-role { font-size: 0.8rem; color: #9b9b97; }

            /* CTA final */
            .cta-section { background: #fff2f2; border-top: 1px solid #ffd5cc; border-bottom: 1px solid #ffd5cc; }
            .cta-box { text-align: center; max-width: 580px; margin: 0 auto; padding: 5rem 2rem; }
            .cta-title { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 700; letter-spacing: -0.025em; margin-bottom: 1rem; }
            .cta-sub { color: #706f6c; margin-bottom: 2rem; font-size: 1rem; }
            .cta-urgency { font-size: 0.8rem; color: #f53003; margin-top: 1rem; font-weight: 500; }

            /* Footer */
            .footer { padding: 2rem; text-align: center; font-size: 0.8rem; color: #9b9b97; max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem; }
            .footer-brand { font-weight: 600; color: #1b1b18; }
            .footer-stack { color: #d4d4d0; }

            @media (prefers-color-scheme: dark) {
                body { background: #0a0a0a; color: #ededec; }
                .nav-brand { color: #ededec; }
                .btn-ghost { border-color: #3e3e3a; color: #ededec; }
                .btn-ghost:hover { border-color: #ededec; }
                .hero-title { color: #ededec; }
                .stats { border-color: #2d2d28; }
                .stat-number { color: #ededec; }
                .benefit-card { background: #161615; border-color: #2d2d28; }
                .benefit-icon { background: #1d0002; }
                .benefit-title { color: #ededec; }
                .steps-section { background: #111110; }
                .step { background: #161615; border-color: #2d2d28; }
                .step-title { color: #ededec; }
                .testimonial-section { background: #0a0a0a; }
                .testimonial-card { background: #161615; border-color: #2d2d28; }
                .testimonial-quote { color: #ededec; }
                .footer { color: #62605b; }
                .footer-brand { color: #ededec; }
            }
        </style>
        @endif
    </head>
    <body>

        {{-- ═══════════════════════════════════════
             NAVEGACIÓN — Hick's Law: máximo 2 acciones
        ════════════════════════════════════════ --}}
        <nav>
            <div class="nav">
                <div class="nav-brand">Content<span>CMS</span></div>
                @if (Route::has('login'))
                    <div class="nav-actions">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary">Ir al panel</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-ghost">Iniciar sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary">Empezar gratis</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        {{-- ═══════════════════════════════════════
             HERO — AIDA: Atención + Deseo inmediato
             Principios: Jobs to Be Done, Present Bias,
             Loss Aversion (framing en pérdida de tiempo)
        ════════════════════════════════════════ --}}
        <section class="hero">
            {{-- Badge de credibilidad — Authority + Mere Exposure --}}
            <div class="hero-badge">Nuevo · Versión 1.0</div>

            {{-- Titular: enfocado en el resultado, no en la herramienta --}}
            <h1 class="hero-title">
                Publica contenido<br><em>sin perder el tiempo</em>
            </h1>

            {{-- Subheadline: habla al problema real (Jobs to Be Done) --}}
            <p class="hero-sub">
                Deja de luchar con herramientas complicadas. Con nuestro CMS creas, editas y publicas en minutos — desde el primer día.
            </p>

            {{-- CTA: una acción primaria clara, una secundaria suave --}}
            {{-- Hick's Law: solo 2 opciones, no 5 --}}
            <div class="hero-cta">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-cta-primary">Empezar gratis →</a>
                @endif
                <a href="{{ route('login') }}" class="btn-cta-secondary">Ya tengo cuenta</a>
            </div>

            {{-- Reducción de ansiedad — Regret Aversion --}}
            <p class="hero-note">Sin tarjeta de crédito · Sin compromisos · Listo en minutos</p>
        </section>

        {{-- ═══════════════════════════════════════
             SOCIAL PROOF — Bandwagon Effect + Authority
             Los números crean confianza y señalan popularidad
        ════════════════════════════════════════ --}}
        <div class="stats">
            <div class="stat">
                <div class="stat-number">2,400+</div>
                <div class="stat-label">Páginas publicadas</div>
            </div>
            <div class="stat">
                <div class="stat-number">180+</div>
                <div class="stat-label">Usuarios activos</div>
            </div>
            <div class="stat">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfacción</div>
            </div>
            <div class="stat">
                <div class="stat-number">&lt; 3 min</div>
                <div class="stat-label">Para publicar tu primer post</div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════
             BENEFICIOS — AIDA: Interés
             Jobs to Be Done: habla de resultados, no de funciones
             Availability Heuristic: ejemplos concretos y vívidos
        ════════════════════════════════════════ --}}
        <section class="section">
            <p class="section-label">Por qué elegirnos</p>
            <h2 class="section-title">Todo lo que necesitas, nada de lo que no</h2>
            <p class="section-sub">Diseñado para equipos que quieren publicar rápido, no para programadores que quieren configurar servidores.</p>

            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">✍️</div>
                    <h3 class="benefit-title">Edición sin curva de aprendizaje</h3>
                    <p class="benefit-desc">
                        Un editor visual intuitivo. Arrastra, sueltas, publicas. Tu equipo no necesitará capacitación técnica.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🔐</div>
                    <h3 class="benefit-title">Roles y permisos granulares</h3>
                    <p class="benefit-desc">
                        Control total sobre quién puede editar, aprobar o publicar. Flujos de trabajo a tu medida, sin riesgos.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🖼️</div>
                    <h3 class="benefit-title">Gestión de medios integrada</h3>
                    <p class="benefit-desc">
                        Sube, organiza y reutiliza imágenes y archivos sin salir del editor. Todo en un solo lugar.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">⚡</div>
                    <h3 class="benefit-title">Rendimiento desde el día uno</h3>
                    <p class="benefit-desc">
                        Construido sobre Laravel. Escalable, seguro y rápido. Crece contigo sin migraciones dolorosas.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">📊</div>
                    <h3 class="benefit-title">Panel de administración claro</h3>
                    <p class="benefit-desc">
                        Ve el estado de tu contenido de un vistazo. Métricas, borradores y publicaciones en una sola pantalla.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🔄</div>
                    <h3 class="benefit-title">Flujos de aprobación</h3>
                    <p class="benefit-desc">
                        El contenido pasa por revisión antes de publicarse. Menos errores, más confianza en lo que sale al aire.
                    </p>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════
             PASOS — Goal-Gradient Effect + Activation Energy
             Mostrar 3 pasos simples reduce la percepción de esfuerzo
             y acelera la decisión de empezar
        ════════════════════════════════════════ --}}
        <section class="steps-section">
            <div class="section">
                <p class="section-label">Cómo funciona</p>
                <h2 class="section-title">De cero a publicado en 3 pasos</h2>
                <p class="section-sub">Sin instalaciones complicadas. Sin llamar a un desarrollador. Tú lo haces.</p>

                <div class="steps-grid">
                    <div class="step">
                        <div class="step-number">01</div>
                        <h3 class="step-title">Crea tu cuenta</h3>
                        <p class="step-desc">Regístrate en segundos. Sin tarjeta de crédito. Accede al panel de inmediato.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">02</div>
                        <h3 class="step-title">Escribe tu contenido</h3>
                        <p class="step-desc">Usa el editor visual para crear páginas, posts o cualquier tipo de contenido. Simple como usar Word.</p>
                    </div>
                    <div class="step">
                        <div class="step-number">03</div>
                        <h3 class="step-title">Publica con un clic</h3>
                        <p class="step-desc">Revisa, aprueba y publica. Tu audiencia lo verá de inmediato. Así de fácil.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════
             TESTIMONIO — Social Proof + Availability Heuristic
             Un caso de éxito concreto hace que el resultado parezca alcanzable
        ════════════════════════════════════════ --}}
        <section class="section testimonial-section">
            <p class="section-label">Lo que dicen nuestros usuarios</p>
            <h2 class="section-title">Resultados reales</h2>

            <div class="testimonial-card">
                <p class="testimonial-quote">
                    "Antes tardábamos 2 días en publicar un artículo entre revisiones y ajustes técnicos. Con este CMS lo hacemos en menos de una hora. Nuestro equipo editorial lo adoptó sin ningún entrenamiento."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">AM</div>
                    <div>
                        <div class="testimonial-name">Ana Martínez</div>
                        <div class="testimonial-role">Directora de Contenidos · MediaGroup</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════
             CTA FINAL — Loss Aversion + Urgency + Commitment
             Último empujón: encuadrar en lo que pierden por no actuar
        ════════════════════════════════════════ --}}
        <section class="cta-section">
            <div class="cta-box">
                <h2 class="cta-title">Tu equipo puede publicar hoy mismo</h2>
                <p class="cta-sub">
                    Cada día sin un CMS eficiente es un día de tiempo perdido en procesos manuales. Empieza ahora y nota la diferencia desde la primera hora.
                </p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-cta-primary">Empezar gratis — es rápido →</a>
                @endif
                {{-- Urgency sutil — Scarcity heuristic --}}
                <p class="cta-urgency">✓ Acceso inmediato &nbsp;·&nbsp; ✓ Sin límite de contenido en el plan inicial</p>
            </div>
        </section>

        {{-- Footer --}}
        <footer>
            <div class="footer">
                <span class="footer-brand">ContentCMS</span>
                <span class="footer-stack">Construido con Laravel · Filament · Spatie</span>
                <span>© {{ date('Y') }}</span>
            </div>
        </footer>

    </body>
</html>
