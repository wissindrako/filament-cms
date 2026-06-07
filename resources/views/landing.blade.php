<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? config('app.name') }} — Automatización que hace crecer tu negocio</title>
    <meta name="description" content="{{ $settings['site_description'] ?? 'Transformamos tu negocio con automatización, desarrollo digital y datos. Resultados medibles desde el primer mes.' }}">

    {{-- Inter: tipografía técnica, precisa — la fuente de los productos que funcionan --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ── Tokens ─────────────────────────────────────── */
        :root {
            --font-base: 'Inter', ui-sans-serif, system-ui, sans-serif;

            --ink-1:        #e2e8f0;
            --ink-2:        #cbd5e1;
            --ink-3:        #94a3b8;
            --ink-4:        #64748b;
            --ink-inv:      #0f172a;

            --surface:      #0d1f12;
            --surface-sub:  #0f2415;
            --surface-dark: #081a0d;
            --surface-pain: #0a1a0d;

            --brand:        #16a34a;
            --brand-hover:  #15803d;
            --brand-dim:    rgba(22,163,74,0.12);
            --brand-border: rgba(22,163,74,0.25);

            --success:      #10b981;
            --warning:      #f59e0b;

            --border:       rgba(255,255,255,0.08);
            --border-dark:  rgba(255,255,255,0.08);

            --r-card:  12px;
            --r-input:  8px;
            --r-badge: 99px;
        }

        /* ── Base ────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { font-family: var(--font-base); }
        body { background: var(--surface); color: var(--ink-1); -webkit-font-smoothing: antialiased; color-scheme: dark; }
        [x-cloak] { display: none !important; }

        /* ── Gradiente de texto de marca ─────────────────── */
        .text-brand-gradient {
            background: linear-gradient(135deg, #4ade80, #22c55e, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Hero ────────────────────────────────────────── */
        .hero-bg {
            background-color: var(--surface-dark);
            background-image: linear-gradient(145deg, #081a0d 0%, #0f2215 45%, #0a2d17 75%, #0c1f14 100%);
        }

        /* ── Firma visual: borde-pipeline ────────────────── */
        /* Aparece en listas de features, diferenciadores y pasos clave
           Evoca "connection point" en un diagrama de flujo              */
        .pipeline-item {
            border-left: 2px solid var(--brand);
            padding-left: 1rem;
        }

        /* ── Sección "dolor" — fondo oscuro pesado ───────── */
        .pain-bg {
            background-color: var(--surface-pain);
            background-image: linear-gradient(160deg, #0a1a0d 0%, #111a13 100%);
        }

        /* ── Tarjetas ────────────────────────────────────── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-card);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .card:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            border-color: rgba(22,163,74,0.35);
        }
        .card-subtle {
            background: var(--surface-sub);
            border: 1px solid var(--border);
            border-radius: var(--r-card);
        }

        /* ── Botones ─────────────────────────────────────── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--brand);
            color: #fff;
            font-weight: 700;
            padding: 0.875rem 2rem;
            border-radius: var(--r-card);
            font-size: 1rem;
            transition: background 0.15s ease, transform 0.1s ease;
            box-shadow: 0 4px 14px rgba(22,163,74,0.3);
        }
        .btn-primary:hover {
            background: var(--brand-hover);
            transform: translateY(-1px);
        }
        .btn-outline-inv {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: #fff;
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: var(--r-card);
            font-size: 1rem;
            border: 1px solid rgba(255,255,255,0.2);
            transition: border-color 0.15s ease;
        }
        .btn-outline-inv:hover { border-color: rgba(255,255,255,0.5); }

        /* ── Label de sección ────────────────────────────── */
        .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--brand);
        }
        .section-label-inv { color: #4ade80; }

        /* ── Slider ──────────────────────────────────────── */
        .slider-btn {
            width: 2.5rem; height: 2.5rem;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: border-color 0.15s, box-shadow 0.15s;
            box-shadow: 0 1px 4px rgba(15,23,42,0.08);
        }
        .slider-btn:hover { border-color: var(--brand); box-shadow: 0 2px 8px rgba(22,163,74,0.15); }
        .slider-btn svg { width: 1.1rem; height: 1.1rem; color: var(--ink-3); transition: color 0.15s; }
        .slider-btn:hover svg { color: var(--brand); }

        /* ── Inputs ──────────────────────────────────────── */
        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: var(--r-input);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: var(--ink-1);
            font-family: var(--font-base);
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .form-input::placeholder { color: var(--ink-4); }
        .form-input:focus { outline: none; border-color: var(--brand); box-shadow: 0 0 0 3px var(--brand-dim); background: rgba(255,255,255,0.07); }

        /* ── Select options dark ────────────────────────── */
        .form-input option { background: #0f2415; color: var(--ink-1); }

        /* ── Animación pulse badge ───────────────────────── */
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════════════════
     NAVBAR
     Fondo blanco sólido con borde sutil — no compite con el hero
═══════════════════════════════════════════════════════════ --}}
<nav class="fixed top-0 w-full z-50 border-b" style="background:var(--surface-dark); border-color: var(--border-dark);" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="#" class="text-lg font-bold tracking-tight" style="color: var(--ink-1);">
                {{ $settings['site_name'] ?? config('app.name') }}
            </a>
            <div class="hidden md:flex items-center gap-7">
                @foreach([
                    ['#services',     'Servicios',       true],
                    ['#about',        'Nosotros',        true],
                    ['#projects',     'Casos de éxito',  $projects->isNotEmpty()],
                    ['#testimonials', 'Testimonios',     $testimonials->isNotEmpty()],
                ] as [$href, $label, $show])
                @if($show)
                <a href="{{ $href }}" style="font-size:0.875rem; font-weight:500; color:var(--ink-3);"
                   onmouseover="this.style.color='var(--brand)'" onmouseout="this.style.color='var(--ink-3)'">
                    {{ $label }}
                </a>
                @endif
                @endforeach
                <a href="#contact" class="btn-primary" style="padding:0.5rem 1.25rem; font-size:0.875rem;">
                    Habla con nosotros
                </a>
            </div>
            <button @click="open = !open" class="md:hidden p-2 rounded-lg" style="color:var(--ink-2);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div x-show="open" x-cloak class="md:hidden py-4 flex flex-col gap-4" style="border-top:1px solid var(--border);">
            @foreach([['#services','Servicios',true],['#about','Nosotros',true],['#projects','Casos de éxito',$projects->isNotEmpty()],['#testimonials','Testimonios',$testimonials->isNotEmpty()]] as [$h,$l,$show])
            @if($show)
            <a href="{{ $h }}" @click="open=false" style="font-size:0.875rem;font-weight:500;color:var(--ink-2);">{{ $l }}</a>
            @endif
            @endforeach
            <a href="#contact" @click="open=false" class="btn-primary" style="justify-content:center;padding:0.625rem 1rem;font-size:0.875rem;">Habla con nosotros</a>
        </div>
    </div>
</nav>

{{-- ═══════════════════════════════════════════════════════════
     HERO — oscuro, aspiracional, denso
     Autoridad visual desde el primer segundo
═══════════════════════════════════════════════════════════ --}}
<section class="hero-bg min-h-screen flex items-center pt-16 relative overflow-hidden">
    {{-- Orbes de fondo —  deliberadamente sutiles --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/3 left-1/4 w-80 h-80 rounded-full" style="background:rgba(22,163,74,0.07); filter:blur(80px);"></div>
        <div class="absolute bottom-1/4 right-1/3 w-64 h-64 rounded-full" style="background:rgba(34,197,94,0.06); filter:blur(60px);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 text-center">

        {{-- Badge de disponibilidad --}}
        <div class="inline-flex items-center gap-2 mb-8 px-4 py-1.5 rounded-full text-sm font-semibold"
             style="background:var(--brand-dim); border:1px solid var(--brand-border); color:#86efac;">
            <span class="w-1.5 h-1.5 rounded-full pulse-dot" style="background:#4ade80;"></span>
            Aceptando nuevos clientes — plazas limitadas este mes
        </div>

        <h1 class="font-extrabold text-white leading-tight tracking-tight mb-5"
            style="font-size:clamp(2.5rem,6vw,4.5rem); letter-spacing:-0.03em;">
            {{ $settings['hero_title'] ?? 'Tu negocio creciendo' }}<br>
            <span class="text-brand-gradient">en piloto automático</span>
        </h1>

        {{-- Frase de marca: une "fly" del brand con el contraste correr vs. volar --}}
        {{-- Zeigarnik: cierra el loop aspiracional del h1 antes del subtitle --}}
        <p style="font-size:1.25rem; font-weight:600; color:#e2e8f0; margin-bottom:1.75rem; letter-spacing:-0.01em;">
            Deja de correr.&nbsp; <span style="color:#4ade80;">Empieza a volar.</span>
        </p>

        <p style="font-size:1.125rem; color:#94a3b8; max-width:36rem; margin:0 auto 0.75rem; line-height:1.7;">
            {{ $settings['hero_subtitle'] ?? 'Automatizamos los procesos que te quitan tiempo, construimos productos digitales que generan ingresos y convertimos tus datos en decisiones que valen dinero.' }}
        </p>
        <p style="font-size:0.875rem; color:#475569; margin-bottom:2.5rem;">
            Cada semana sin automatización es tiempo y dinero que no recuperas.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center mb-24">
            <a href="#contact" class="btn-primary">
                {{ $settings['hero_cta_text'] ?? 'Quiero resultados ahora' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <a href="#projects" class="btn-outline-inv">
                {{ $settings['hero_secondary_cta_text'] ?? 'Ver casos de éxito' }}
            </a>
        </div>

        {{-- Stats con firma pipeline --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-px max-w-3xl mx-auto"
             style="border-top:1px solid var(--border-dark); padding-top:3rem;">
            @foreach([
                ['50+',  'Proyectos entregados'],
                ['8+',   'Años automatizando negocios'],
                ['30+',  'Empresas transformadas'],
                ['99%',  'Clientes que repiten'],
            ] as [$num, $label])
            <div class="text-center px-4">
                <div class="font-extrabold text-white mb-1"
                     style="font-size:clamp(1.75rem,4vw,2.25rem); letter-spacing:-0.03em;">{{ $num }}</div>
                <div style="font-size:0.75rem; color:#64748b; line-height:1.4;">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     PROBLEMA — fondo oscuro pesado
     El dolor debe sentirse incómodo, no en un fondo blanco neutro
═══════════════════════════════════════════════════════════ --}}
<section class="pain-bg py-24">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <p class="section-label section-label-inv mb-3">¿Te suena familiar?</p>
            <h2 class="font-bold text-white mb-5 leading-tight"
                style="font-size:clamp(1.75rem,3.5vw,2.5rem); letter-spacing:-0.025em;">
                Tu equipo hace tareas manuales<br class="hidden sm:block"> que deberían hacer las máquinas
            </h2>
            <p style="font-size:1rem; color:#64748b; max-width:34rem; margin:0 auto; line-height:1.7;">
                Horas perdidas en reportes y seguimientos. Mientras tanto, tus competidores ya están automatizados.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'Procesos manuales que consumen horas',
                    'desc'  => 'Tu equipo invierte tiempo en tareas repetitivas que podrían ejecutarse solas, cada día, sin errores.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                    'title' => 'Decisiones basadas en intuición',
                    'desc'  => 'Sin dashboards ni datos confiables, cada decisión importante es un riesgo innecesario.',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'Proyectos que nunca terminan',
                    'desc'  => 'Ideas que se quedan en el cajón porque la tecnología tarda meses en implementarse.',
                ],
            ] as $item)
            <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07); border-radius:var(--r-card); padding:1.75rem;">
                <div class="mb-4" style="width:2.5rem;height:2.5rem;background:rgba(22,163,74,0.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg style="width:1.25rem;height:1.25rem;color:#4ade80;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-semibold mb-2" style="color:#e2e8f0;font-size:0.9375rem;">{{ $item['title'] }}</h3>
                <p style="font-size:0.875rem;color:#475569;line-height:1.65;">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="#services" style="font-size:0.875rem;font-weight:600;color:#4ade80;display:inline-flex;align-items:center;gap:0.4rem;">
                Nosotros resolvemos esto
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SERVICIOS — blanco, alivio visual después del dolor
     Slider Alpine.js con firma pipeline en features
═══════════════════════════════════════════════════════════ --}}
<section id="services" style="background:var(--surface);padding:6rem 0;overflow:hidden;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12">
            <p class="section-label mb-3">Lo que hacemos</p>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <h2 class="font-bold leading-tight"
                    style="font-size:clamp(1.75rem,3vw,2.25rem);letter-spacing:-0.025em;color:var(--ink-1);max-width:32rem;">
                    {{ $settings['services_title'] ?? 'Soluciones que generan resultados medibles' }}
                </h2>
                <p style="font-size:0.9375rem;color:var(--ink-3);max-width:22rem;line-height:1.6;">
                    No vendemos tecnología. Vendemos tiempo recuperado, ingresos generados y ventaja competitiva.
                </p>
            </div>
        </div>

        {{-- Slider --}}
        <div
            x-data="{
                current: 0,
                perPage: 3,
                timer: null,
                get cards() { return this.$el.querySelectorAll('.service-card'); },
                get total() { return this.cards.length; },
                get maxIndex() { return Math.max(0, this.total - this.perPage); },
                get cardWidth() { return 100 / this.perPage; },
                init() {
                    this.calcPerPage();
                    window.addEventListener('resize', () => {
                        this.calcPerPage();
                        this.current = Math.min(this.current, this.maxIndex);
                    });
                    this.startAutoplay();
                },
                calcPerPage() {
                    const w = window.innerWidth;
                    this.perPage = w < 640 ? 1 : w < 1024 ? 2 : 3;
                },
                prev() { this.current = this.current > 0 ? this.current - 1 : this.maxIndex; this.resetAutoplay(); },
                next() { this.current = this.current < this.maxIndex ? this.current + 1 : 0; this.resetAutoplay(); },
                goTo(i) { this.current = i; this.resetAutoplay(); },
                startAutoplay() { this.timer = setInterval(() => this.next(), 4500); },
                resetAutoplay() { clearInterval(this.timer); this.startAutoplay(); },
                dots() { return Array.from({ length: this.maxIndex + 1 }); }
            }"
            x-init="init()"
            @mouseenter="clearInterval(timer)"
            @mouseleave="startAutoplay()"
            class="relative"
        >
            {{-- Flechas --}}
            <button @click="prev()" class="slider-btn absolute left-0 top-1/2 -translate-y-1/2 -translate-x-5 z-10" aria-label="Anterior">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="next()" class="slider-btn absolute right-0 top-1/2 -translate-y-1/2 translate-x-5 z-10" aria-label="Siguiente">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Track --}}
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out"
                     :style="`transform: translateX(-${current * cardWidth}%)`">

                    @if($services->isEmpty())
                    @foreach([
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',   'title'=>'Automatización de Procesos',      'short'=>'Flujos automáticos que corren solos 24/7. Tu equipo deja de hacer lo que puede hacer una máquina y se enfoca en lo que realmente importa.',               'result'=>'Ahorra +20h/semana por empleado', 'feats'=>['Automatización de reportes y alertas','Flujos de aprobación sin intervención','Integración con +200 herramientas']],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',                                                                          'title'=>'Desarrollo de Productos Digitales','short'=>'De la idea al producto en manos de tus clientes. Apps y plataformas que venden, retienen y escalan sin caerse.',                                           'result'=>'MVP listo en 6-8 semanas',        'feats'=>['Arquitectura escalable desde el día uno','Diseño UX centrado en conversión','Testing y despliegue continuo']],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>','title'=>'Inteligencia de Datos',          'short'=>'Dashboards en tiempo real que te dicen exactamente qué funciona y qué estás perdiendo. Sin esperar al área de IT.',                                         'result'=>'Decisiones 3x más rápidas',       'feats'=>['Dashboards para directivos y operaciones','Alertas automáticas ante anomalías','Modelos predictivos de tendencias']],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>',                      'title'=>'Infraestructura Cloud',           'short'=>'Arquitectura en la nube que crece contigo, no se cae cuando más la necesitas y reduce costos operativos al escalar.',                                      'result'=>'Uptime 99.9% garantizado',        'feats'=>['Migración sin tiempo de inactividad','Escalado automático según demanda','Backup y recuperación ante fallos']],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',                        'title'=>'Integraciones y APIs',            'short'=>'CRM, ERP, tienda online y cualquier herramienta hablando entre sí. La información fluye sola, sin que nadie la copie manualmente.',                      'result'=>'Elimina la doble digitación',     'feats'=>['Conectores para CRM, ERP y e-commerce','APIs RESTful y webhooks a medida','Sincronización en tiempo real']],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>',                         'title'=>'DevOps & Entrega Continua',       'short'=>'Lanza sin miedo. Pipelines que despliegan código seguro, rápido y sin interrupciones para tus usuarios.',                                                 'result'=>'Deploy en horas, no semanas',     'feats'=>['CI/CD con GitHub Actions o GitLab','Contenedores Docker y Kubernetes','Rollback automático ante fallos']],
                    ] as $svc)
                    <div class="service-card flex-shrink-0 px-3" :style="`width: ${cardWidth}%`">
                        <div class="card h-full flex flex-col p-7">
                            <div class="mb-5" style="width:2.75rem;height:2.75rem;background:var(--brand-dim);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg style="width:1.25rem;height:1.25rem;color:var(--brand);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $svc['icon'] !!}
                                </svg>
                            </div>
                            <h3 style="font-size:1rem;font-weight:700;color:var(--ink-1);margin-bottom:0.625rem;">{{ $svc['title'] }}</h3>
                            <p style="font-size:0.875rem;color:var(--ink-3);line-height:1.65;flex:1;margin-bottom:1.25rem;">{{ $svc['short'] }}</p>
                            <ul style="margin-bottom:1.25rem;display:flex;flex-direction:column;gap:0.5rem;">
                                @foreach($svc['feats'] as $feat)
                                <li class="pipeline-item" style="font-size:0.8125rem;color:var(--ink-2);line-height:1.5;">{{ $feat }}</li>
                                @endforeach
                            </ul>
                            <div style="display:inline-flex;align-items:center;gap:0.375rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:var(--r-badge);padding:0.3rem 0.75rem;width:fit-content;">
                                <svg style="width:0.875rem;height:0.875rem;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span style="font-size:0.75rem;font-weight:700;color:#16a34a;">{{ $svc['result'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else
                    @foreach($services as $service)
                    <div class="service-card flex-shrink-0 px-3" :style="`width: ${cardWidth}%`">
                        <div class="card h-full flex flex-col overflow-hidden">
                            @if($service->hasMedia('cover'))
                            <img src="{{ $service->getFirstMediaUrl('cover') }}" alt="{{ $service->title }}"
                                 class="w-full object-cover" style="height:11rem;">
                            @else
                            <div style="height:11rem;background:linear-gradient(135deg,#16a34a,#15803d);display:flex;align-items:center;justify-content:center;">
                                <svg style="width:3rem;height:3rem;color:rgba(255,255,255,0.25);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="flex flex-col flex-1 p-6">
                                <h3 style="font-size:1rem;font-weight:700;color:var(--ink-1);margin-bottom:0.5rem;">{{ $service->title }}</h3>
                                <p style="font-size:0.875rem;color:var(--ink-3);line-height:1.65;flex:1;margin-bottom:1rem;">{{ $service->short_description }}</p>
                                @if($service->features)
                                <ul style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1rem;">
                                    @foreach(array_slice($service->features, 0, 3) as $feat)
                                    <li class="pipeline-item" style="font-size:0.8125rem;color:var(--ink-2);line-height:1.5;">{{ $feat['feature'] ?? $feat }}</li>
                                    @endforeach
                                </ul>
                                @endif
                                <a href="#contact" style="font-size:0.875rem;font-weight:700;color:var(--brand);display:inline-flex;align-items:center;gap:0.375rem;margin-top:auto;">
                                    Saber más
                                    <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>

            {{-- Dots --}}
            <div class="flex justify-center gap-2 mt-8">
                <template x-for="(_, i) in dots()" :key="i">
                    <button @click="goTo(i)"
                        class="rounded-full transition-all duration-300"
                        :style="current === i
                            ? 'width:1.5rem;height:0.5rem;background:var(--brand);'
                            : 'width:0.5rem;height:0.5rem;background:var(--border);'"
                        :aria-label="`Slide ${i + 1}`">
                    </button>
                </template>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="#contact" style="font-size:0.875rem;font-weight:600;color:var(--brand);display:inline-flex;align-items:center;gap:0.375rem;">
                ¿No ves lo que necesitas? Hablemos de tu caso específico
                <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     NOSOTROS — dos columnas, fondo sutil
     Métricas con firma pipeline, no emojis
═══════════════════════════════════════════════════════════ --}}
<section id="about" style="background:var(--surface-sub);padding:6rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            <div>
                <p class="section-label mb-4">Por qué elegirnos</p>
                <h2 class="font-bold leading-tight mb-5"
                    style="font-size:clamp(1.75rem,3vw,2.25rem);letter-spacing:-0.025em;color:var(--ink-1);">
                    {{ $settings['about_title'] ?? 'No somos una agencia más. Somos el equipo técnico que habla el lenguaje del negocio.' }}
                </h2>
                <p style="font-size:1rem;color:var(--ink-2);line-height:1.75;margin-bottom:2rem;">
                    {{ $settings['about_text'] ?? 'Llevamos 8 años convirtiendo problemas reales en soluciones que funcionan. No te vendemos horas — te entregamos resultados medibles desde el primer mes.' }}
                </p>

                <div style="display:flex;flex-direction:column;gap:1.25rem;">
                    @foreach([
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>','title'=>'Obsesionados con resultados','desc'=>'Medimos todo. Puntos de control claros desde el día uno. Si no hay impacto en tu negocio, no nos consideramos exitosos.'],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>',                                                                                                                                                                                                                                                                                                                                                                                                                                                                   'title'=>'Velocidad sin sacrificar calidad',  'desc'=>'Metodología probada que entrega MVPs en semanas, no en meses. Sin sorpresas de alcance ni fechas que se mueven.'],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>',                                                                                                                                                                                                                   'title'=>'Tu éxito es nuestro negocio',       'desc'=>'El 78% de nuestros proyectos vienen de clientes que repiten o nos recomiendan. Eso no pasa por accidente.'],
                        ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',                                                                                                                                                       'title'=>'Transparencia total',               'desc'=>'Acceso en tiempo real al progreso. Sin reportes de relleno. Sabes qué está pasando y por qué, siempre.'],
                    ] as $item)
                    <div style="display:flex;gap:1rem;align-items:flex-start;">
                        <div style="width:2.5rem;height:2.5rem;background:var(--brand-dim);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg style="width:1.1rem;height:1.1rem;color:var(--brand);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700;color:var(--ink-1);font-size:0.9375rem;margin-bottom:0.25rem;">{{ $item['title'] }}</div>
                            <div style="font-size:0.875rem;color:var(--ink-3);line-height:1.6;">{{ $item['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:1rem;">
                {{-- Métrica principal con firma pipeline --}}
                <div style="background:var(--brand);border-radius:var(--r-card);padding:2rem;border-left:4px solid #86efac;">
                    <div style="font-size:3.5rem;font-weight:800;color:#fff;line-height:1;letter-spacing:-0.04em;margin-bottom:0.5rem;">+40%</div>
                    <div style="font-weight:600;color:#fff;font-size:1.0625rem;margin-bottom:0.375rem;">Incremento promedio de productividad</div>
                    <div style="font-size:0.875rem;color:#bbf7d0;line-height:1.6;">En los primeros 90 días. Medido en horas recuperadas por el equipo del cliente.</div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                    @foreach([
                        ['3×',     'Más rápido en toma de decisiones con datos'],
                        ['80%',    'Reducción de errores en procesos automatizados'],
                        ['6 sem',  'Tiempo promedio de entrega del primer MVP'],
                        ['24/7',   'Soporte y monitoreo post-lanzamiento incluido'],
                    ] as [$num, $desc])
                    <div class="card-subtle" style="padding:1.25rem;border-left:2px solid var(--brand-border);">
                        <div style="font-size:1.625rem;font-weight:800;color:var(--ink-1);letter-spacing:-0.03em;margin-bottom:0.25rem;">{{ $num }}</div>
                        <div style="font-size:0.8125rem;color:var(--ink-3);line-height:1.5;">{{ $desc }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     PROCESO — 3 pasos con conectores reales
═══════════════════════════════════════════════════════════ --}}
<section style="background:var(--surface);padding:6rem 0;">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="section-label mb-3">Así trabajamos</p>
        <h2 class="font-bold mb-4" style="font-size:clamp(1.75rem,3vw,2.25rem);letter-spacing:-0.025em;color:var(--ink-1);">
            De la conversación al resultado en 3 pasos
        </h2>
        <p style="font-size:1rem;color:var(--ink-3);margin-bottom:3.5rem;max-width:32rem;margin-left:auto;margin-right:auto;line-height:1.7;">
            Sin burocracia. Empezamos rápido porque sabemos que tu tiempo vale.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left relative">
            @foreach([
                ['01', 'Diagnóstico gratuito',        'Reunión de 45 min. Analizamos tus procesos, identificamos cuellos de botella y calculamos cuánto puedes ganar automatizando.',          'Sin costo · Sin compromiso'],
                ['02', 'Plan con ROI proyectado',     'Roadmap con hitos claros, tiempos reales y retorno esperado. Sabes exactamente qué vas a obtener antes de firmar.',                    'Propuesta en 48h'],
                ['03', 'Ejecución y resultados',      'Implementamos, medimos y ajustamos. Cada sprint tiene entregables concretos. Ves el avance en tiempo real desde el día uno.',         'Primeros resultados en 30 días'],
            ] as $i => [$num, $title, $desc, $badge])
            <div class="card p-7 relative">
                {{-- Conector hacia la derecha (solo desktop, excepto último) --}}
                @if($i < 2)
                <div class="hidden md:block absolute top-9 -right-3 z-10" style="width:1.5rem;height:2px;background:var(--brand-border);">
                    <div style="position:absolute;right:-3px;top:-3px;width:8px;height:8px;border-radius:50%;background:var(--brand);opacity:0.5;"></div>
                </div>
                @endif
                <div style="width:2.25rem;height:2.25rem;background:var(--brand);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.8125rem;color:#fff;margin-bottom:1.25rem;">{{ $num }}</div>
                <h3 style="font-weight:700;color:var(--ink-1);font-size:1rem;margin-bottom:0.625rem;">{{ $title }}</h3>
                <p style="font-size:0.875rem;color:var(--ink-3);line-height:1.65;margin-bottom:1rem;">{{ $desc }}</p>
                <span style="display:inline-block;background:var(--brand-dim);border:1px solid var(--brand-border);border-radius:var(--r-badge);padding:0.25rem 0.75rem;font-size:0.75rem;font-weight:700;color:var(--brand);">{{ $badge }}</span>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            <a href="#contact" class="btn-primary" style="display:inline-flex;">
                Solicita tu diagnóstico gratuito
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <p style="font-size:0.8125rem;color:var(--ink-4);margin-top:0.75rem;">Sin tarjeta · Solo 45 minutos · 100% gratis</p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     PROYECTOS — solo si hay contenido publicado
═══════════════════════════════════════════════════════════ --}}
@if($projects->isNotEmpty())
<section id="projects" style="background:var(--surface-sub);padding:6rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <p class="section-label mb-3">Resultados reales</p>
            <h2 class="font-bold mb-3" style="font-size:clamp(1.75rem,3vw,2.25rem);letter-spacing:-0.025em;color:var(--ink-1);">
                {{ $settings['projects_title'] ?? 'Casos de éxito que hablan solos' }}
            </h2>
            <p style="font-size:0.9375rem;color:var(--ink-3);max-width:30rem;margin:0 auto;">No prometemos, demostramos.</p>
        </div>

        @if($projects->isEmpty())
        <div style="text-align:center;padding:4rem 0;">
            <div style="width:3rem;height:3rem;background:var(--border);border-radius:50%;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;">
                <svg style="width:1.25rem;height:1.25rem;color:var(--ink-4);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <p style="font-size:0.9375rem;color:var(--ink-3);">Los casos de éxito se publicarán desde el panel.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="card overflow-hidden group">
                @if($project->hasMedia('cover'))
                <img src="{{ $project->getFirstMediaUrl('cover') }}" alt="{{ $project->title }}"
                     class="w-full object-cover" style="height:13rem;transition:transform 0.4s ease;"
                     onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                @else
                <div style="height:13rem;background:linear-gradient(135deg,#16a34a,#15803d);display:flex;align-items:center;justify-content:center;">
                    <svg style="width:3.5rem;height:3.5rem;color:rgba(255,255,255,0.2);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                </div>
                @endif
                <div style="padding:1.5rem;">
                    @if($project->featured)
                    <span style="display:inline-block;background:#fef3c7;color:#92400e;font-size:0.75rem;font-weight:700;padding:0.25rem 0.625rem;border-radius:var(--r-badge);margin-bottom:0.75rem;letter-spacing:0.02em;">DESTACADO</span>
                    @endif
                    <h3 style="font-size:1rem;font-weight:700;color:var(--ink-1);margin-bottom:0.375rem;">{{ $project->title }}</h3>
                    <p style="font-size:0.875rem;color:var(--ink-3);line-height:1.65;margin-bottom:0.875rem;">{{ $project->short_description }}</p>
                    @if($project->tech_stack)
                    <div style="display:flex;flex-wrap:wrap;gap:0.375rem;margin-bottom:0.875rem;">
                        @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                        <span style="background:var(--brand-dim);color:var(--brand);font-size:0.75rem;font-weight:600;padding:0.2rem 0.625rem;border-radius:var(--r-badge);">{{ $tech['tech'] ?? $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                    @if($project->url)
                    <a href="{{ $project->url }}" target="_blank" rel="noopener"
                       style="font-size:0.875rem;font-weight:700;color:var(--brand);display:inline-flex;align-items:center;gap:0.375rem;">
                        Ver caso completo
                        <svg style="width:0.875rem;height:0.875rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     TESTIMONIOS — solo si hay contenido publicado
═══════════════════════════════════════════════════════════ --}}
@if($testimonials->isNotEmpty())
<section id="testimonials" style="background:var(--surface);padding:6rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <p class="section-label mb-3">Testimonios</p>
            <h2 class="font-bold" style="font-size:clamp(1.75rem,3vw,2.25rem);letter-spacing:-0.025em;color:var(--ink-1);">
                {{ $settings['testimonials_title'] ?? 'Lo que dicen quienes ya lo vivieron' }}
            </h2>
        </div>

        @if($testimonials->isEmpty())
        <div style="text-align:center;padding:3rem 0;">
            <p style="font-size:0.9375rem;color:var(--ink-3);">Los testimonios aparecerán aquí una vez publicados desde el panel.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
            <div class="card-subtle flex flex-col" style="padding:2rem;border-left:2px solid var(--brand-border);">
                <div style="display:flex;margin-bottom:1rem;">
                    @for($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                    <svg style="width:1rem;height:1rem;color:#f59e0b;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <p style="font-size:0.9375rem;color:var(--ink-2);line-height:1.7;font-style:italic;flex:1;margin-bottom:1.5rem;">"{{ $testimonial->content }}"</p>
                <div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid var(--border);">
                    @if($testimonial->hasMedia('avatar'))
                    <img src="{{ $testimonial->getFirstMediaUrl('avatar') }}" alt="{{ $testimonial->author_name }}"
                         style="width:2.5rem;height:2.5rem;border-radius:50%;object-fit:cover;flex-shrink:0;">
                    @else
                    <div style="width:2.5rem;height:2.5rem;border-radius:50%;background:var(--brand);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.8125rem;flex-shrink:0;">
                        {{ strtoupper(substr($testimonial->author_name, 0, 2)) }}
                    </div>
                    @endif
                    <div>
                        <div style="font-weight:700;color:var(--ink-1);font-size:0.875rem;">{{ $testimonial->author_name }}</div>
                        <div style="font-size:0.8125rem;color:var(--ink-4);margin-top:0.125rem;">
                            {{ $testimonial->author_role }}{{ $testimonial->company ? ' · ' . $testimonial->company : '' }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     CONTACTO — oscuro, cierre potente
═══════════════════════════════════════════════════════════ --}}
<section id="contact" class="hero-bg py-24 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 right-0 w-80 h-80 rounded-full" style="background:rgba(22,163,74,0.06);filter:blur(80px);transform:translate(30%,-30%);"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full" style="background:rgba(22,163,74,0.05);filter:blur(60px);transform:translate(-30%,30%);"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-14 items-start">

            <div>
                <p class="section-label section-label-inv mb-4">Hablemos hoy</p>
                <h2 class="font-bold text-white leading-tight mb-5"
                    style="font-size:clamp(1.75rem,3vw,2.5rem);letter-spacing:-0.025em;">
                    ¿Cuánto te cuesta cada semana
                    <span style="color:#fbbf24;">no estar automatizado?</span>
                </h2>
                <p style="font-size:1rem;color:#94a3b8;line-height:1.75;margin-bottom:2rem;">
                    Una conversación de 45 minutos puede revelarte exactamente qué procesos frenan tu crecimiento y cuánto dinero dejas en la mesa.
                </p>

                <div style="display:flex;flex-direction:column;gap:0.75rem;margin-bottom:2rem;">
                    @foreach([
                        'Diagnóstico gratuito de tus procesos actuales',
                        'Estimación real del ROI de automatizar',
                        'Hoja de ruta sin compromiso de compra',
                        'Respuesta en menos de 24 horas hábiles',
                    ] as $item)
                    <div class="pipeline-item" style="border-left-color:rgba(22,163,74,0.4);">
                        <span style="font-size:0.875rem;font-weight:500;color:#cbd5e1;">{{ $item }}</span>
                    </div>
                    @endforeach
                </div>

                @if(($settings['contact_email'] ?? null) || ($settings['contact_phone'] ?? null))
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    @if($settings['contact_email'] ?? null)
                    <a href="mailto:{{ $settings['contact_email'] }}" style="display:flex;align-items:center;gap:0.625rem;font-size:0.875rem;font-weight:500;color:#94a3b8;transition:color 0.15s;"
                       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">
                        <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $settings['contact_email'] }}
                    </a>
                    @endif
                    @if($settings['contact_phone'] ?? null)
                    <a href="tel:{{ $settings['contact_phone'] }}" style="display:flex;align-items:center;gap:0.625rem;font-size:0.875rem;font-weight:500;color:#94a3b8;transition:color 0.15s;"
                       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">
                        <svg style="width:1rem;height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $settings['contact_phone'] }}
                    </a>
                    @endif
                </div>
                @endif
            </div>

            {{-- Formulario sobre fondo oscuro --}}
            <div style="background:#0f2415;border:1px solid rgba(255,255,255,0.08);border-radius:var(--r-card);padding:2rem;box-shadow:0 25px 60px rgba(0,0,0,0.5);"
                 x-data="{ sending: false }">

                @if(session('contact_success'))
                {{-- Estado: enviado correctamente --}}
                <div style="text-align:center;padding:2rem 0;">
                    <div style="width:3.5rem;height:3.5rem;background:rgba(22,163,74,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <svg style="width:1.75rem;height:1.75rem;color:#16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 style="font-size:1.125rem;font-weight:700;color:var(--ink-1);margin-bottom:0.5rem;">Mensaje recibido</h3>
                    <p style="font-size:0.875rem;color:var(--ink-3);line-height:1.6;">Nos pondremos en contacto contigo en menos de 24 horas hábiles.</p>
                </div>
                @else

                <h3 style="font-size:1.125rem;font-weight:700;color:var(--ink-1);margin-bottom:0.25rem;">Solicita tu diagnóstico gratuito</h3>
                <p style="font-size:0.875rem;color:var(--ink-3);margin-bottom:1.5rem;">Respondemos en menos de 24 horas hábiles.</p>

                <form action="{{ route('contact.store') }}" method="POST"
                      style="display:flex;flex-direction:column;gap:1rem;"
                      @submit="sending = true">
                    @csrf

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                        <div>
                            <label style="display:block;font-size:0.8125rem;font-weight:600;color:var(--ink-2);margin-bottom:0.375rem;">Nombre</label>
                            <input type="text" name="name" placeholder="Tu nombre" class="form-input"
                                   value="{{ old('name') }}" style="{{ $errors->has('name') ? 'border-color:#ef4444;' : '' }}">
                            @error('name')<p style="font-size:0.75rem;color:#ef4444;margin-top:0.25rem;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-size:0.8125rem;font-weight:600;color:var(--ink-2);margin-bottom:0.375rem;">Email</label>
                            <input type="email" name="email" placeholder="tu@empresa.com" class="form-input"
                                   value="{{ old('email') }}" style="{{ $errors->has('email') ? 'border-color:#ef4444;' : '' }}">
                            @error('email')<p style="font-size:0.75rem;color:#ef4444;margin-top:0.25rem;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label style="display:block;font-size:0.8125rem;font-weight:600;color:var(--ink-2);margin-bottom:0.375rem;">¿Qué quieres automatizar?</label>
                        <select name="service" class="form-input">
                            <option value="">Selecciona el área</option>
                            @foreach($services as $service)
                            <option value="{{ $service->title }}" {{ old('service') === $service->title ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                            @endforeach
                            @if($services->isEmpty())
                            <option value="Automatización de procesos">Automatización de procesos</option>
                            <option value="Desarrollo de producto digital">Desarrollo de producto digital</option>
                            <option value="Análisis de datos">Análisis de datos</option>
                            @endif
                            <option value="Otro">Otro / No estoy seguro</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block;font-size:0.8125rem;font-weight:600;color:var(--ink-2);margin-bottom:0.375rem;">Tu situación en pocas palabras</label>
                        <textarea name="message" rows="3" placeholder="¿Qué proceso o problema quieres resolver?"
                                  class="form-input" style="resize:none;{{ $errors->has('message') ? 'border-color:#ef4444;' : '' }}">{{ old('message') }}</textarea>
                        @error('message')<p style="font-size:0.75rem;color:#ef4444;margin-top:0.25rem;">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary" style="justify-content:center;width:100%;"
                            :disabled="sending" :style="sending ? 'opacity:0.7;cursor:not-allowed;' : ''">
                        <span x-show="!sending">Quiero mi diagnóstico gratuito</span>
                        <span x-show="sending" x-cloak>Enviando...</span>
                        <svg x-show="!sending" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <p style="text-align:center;font-size:0.75rem;color:var(--ink-4);">Sin spam · Sin compromiso · Confidencial</p>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer style="background:#060d08;border-top:1px solid rgba(255,255,255,0.05);padding:3rem 0;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="display:flex;flex-direction:column;gap:1.5rem;" class="sm:flex-row sm:justify-between sm:items-center">
            <div>
                <div style="font-size:1.125rem;font-weight:700;color:#f1f5f9;margin-bottom:0.25rem;">
                    {{ $settings['site_name'] ?? config('app.name') }}
                </div>
                <div style="font-size:0.875rem;color:#475569;">{{ $settings['site_description'] ?? 'Automatización y soluciones digitales.' }}</div>
            </div>
            <div style="display:flex;align-items:center;gap:0.75rem;">
                @foreach([
                    ['social_github',   'M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z'],
                    ['social_linkedin', 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z'],
                    ['social_twitter',  'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'],
                ] as [$key, $path])
                @if($settings[$key] ?? null)
                <a href="{{ $settings[$key] }}" target="_blank" rel="noopener"
                   style="width:2.25rem;height:2.25rem;border-radius:8px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);display:flex;align-items:center;justify-content:center;transition:background 0.15s;"
                   onmouseover="this.style.background='rgba(22,163,74,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                    <svg style="width:0.9rem;height:0.9rem;color:#64748b;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="{{ $path }}"/>
                    </svg>
                </a>
                @endif
                @endforeach
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.05);margin-top:2rem;padding-top:2rem;display:flex;flex-direction:column;gap:0.5rem;font-size:0.8125rem;color:#1e293b;" class="sm:flex-row sm:justify-between">
            <span>© {{ date('Y') }} {{ $settings['site_name'] ?? config('app.name') }}. Todos los derechos reservados.</span>
            <a href="/admin" style="color:#1e293b;transition:color 0.15s;"
               onmouseover="this.style.color='#64748b'" onmouseout="this.style.color='#1e293b'">
                Panel de administración →
            </a>
        </div>
    </div>
</footer>

</body>
</html>
