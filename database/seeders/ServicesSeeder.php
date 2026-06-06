<?php

namespace Database\Seeders;

use App\Enums\ContentStatus;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@admin.com')->first();

        $services = [
            [
                'title'             => 'Automatización de Procesos',
                'short_description' => 'Elimina el trabajo repetitivo de tu equipo. Flujos automáticos que corren solos 24/7 mientras tu negocio crece sin que nadie toque un botón.',
                'description'       => 'Diseñamos e implementamos flujos de automatización a medida para tu empresa. Integramos tus herramientas existentes, eliminamos la intervención manual en procesos repetitivos y te damos visibilidad total sobre cada tarea ejecutada. Desde notificaciones automáticas hasta aprobaciones encadenadas, todo funciona solo.',
                'icon'              => 'heroicon-o-cog-6-tooth',
                'features'          => [
                    ['feature' => 'Automatización de reportes y notificaciones'],
                    ['feature' => 'Flujos de aprobación sin intervención humana'],
                    ['feature' => 'Integración con más de 200 herramientas'],
                    ['feature' => 'Monitoreo y alertas en tiempo real'],
                    ['feature' => 'Ahorro comprobado de +20 horas por empleado/semana'],
                ],
                'order'  => 1,
                'result' => 'Ahorra +20h/semana por empleado',
            ],
            [
                'title'             => 'Desarrollo de Productos Digitales',
                'short_description' => 'De la idea al producto en manos de tus clientes. Aplicaciones y plataformas que venden, retienen usuarios y escalan sin caerse.',
                'description'       => 'Construimos productos digitales desde cero con metodología ágil. Entregamos un MVP funcional en 6 a 8 semanas para que valides tu idea con usuarios reales antes de invertir a escala. Priorizamos lo que genera valor, eliminamos lo que no y lanzamos rápido.',
                'icon'              => 'heroicon-o-code-bracket',
                'features'          => [
                    ['feature' => 'MVP funcional en 6-8 semanas'],
                    ['feature' => 'Arquitectura escalable desde el día uno'],
                    ['feature' => 'Diseño UX centrado en conversión'],
                    ['feature' => 'Testing automatizado y despliegue continuo'],
                    ['feature' => 'Soporte post-lanzamiento incluido'],
                ],
                'order'  => 2,
                'result' => 'MVP listo en 6-8 semanas',
            ],
            [
                'title'             => 'Inteligencia de Datos',
                'short_description' => 'Convierte tus números en decisiones. Dashboards en tiempo real que te dicen exactamente qué funciona y qué estás perdiendo.',
                'description'       => 'Unificamos tus fuentes de datos dispersas en un solo lugar y construimos dashboards accionables que tu equipo realmente usa. Sin reportes en Excel, sin esperar al área de IT. La información que necesitas, cuando la necesitas, con alertas automáticas cuando algo cambia.',
                'icon'              => 'heroicon-o-chart-bar',
                'features'          => [
                    ['feature' => 'Dashboards en tiempo real para directivos y operaciones'],
                    ['feature' => 'Unificación de datos de múltiples fuentes'],
                    ['feature' => 'Alertas automáticas ante anomalías'],
                    ['feature' => 'Modelos predictivos para anticipar tendencias'],
                    ['feature' => 'Reportes automáticos sin intervención manual'],
                ],
                'order'  => 3,
                'result' => 'Decisiones 3x más rápidas',
            ],
            [
                'title'             => 'Infraestructura Cloud',
                'short_description' => 'Tu tecnología crece con tu negocio. Arquitectura en la nube que no se cae cuando más la necesitas y que reduce costos al escalar.',
                'description'       => 'Diseñamos y migramos tu infraestructura a la nube con las mejores prácticas de seguridad y costo-eficiencia. Ya sea AWS, GCP o Azure, construimos entornos que escalan automáticamente con la demanda y garantizan disponibilidad del 99.9%.',
                'icon'              => 'heroicon-o-cloud',
                'features'          => [
                    ['feature' => 'Migración a la nube sin tiempo de inactividad'],
                    ['feature' => 'Escalado automático según demanda'],
                    ['feature' => 'Reducción de costos de infraestructura hasta 40%'],
                    ['feature' => 'Backup automatizado y recuperación ante fallos'],
                    ['feature' => 'Monitoreo 24/7 con respuesta en minutos'],
                ],
                'order'  => 4,
                'result' => 'Uptime 99.9% garantizado',
            ],
            [
                'title'             => 'Integraciones y APIs',
                'short_description' => 'Tus herramientas hablando entre sí. Conectamos tu CRM, ERP y tienda online para que la información fluya sin fricción ni doble digitación.',
                'description'       => 'Eliminamos los silos de información conectando todos tus sistemas. Desarrollamos integraciones robustas entre plataformas como Salesforce, SAP, HubSpot, WooCommerce y cualquier herramienta con API. Un dato se ingresa una vez y fluye a donde debe estar, automáticamente.',
                'icon'              => 'heroicon-o-arrows-right-left',
                'features'          => [
                    ['feature' => 'Conectores para CRM, ERP y e-commerce'],
                    ['feature' => 'APIs RESTful y webhooks a medida'],
                    ['feature' => 'Sincronización de datos en tiempo real'],
                    ['feature' => 'Mapeo y transformación de datos entre sistemas'],
                    ['feature' => 'Documentación técnica completa incluida'],
                ],
                'order'  => 5,
                'result' => 'Elimina la doble digitación',
            ],
            [
                'title'             => 'DevOps & Entrega Continua',
                'short_description' => 'Lanza actualizaciones sin miedo. Pipelines automáticos que despliegan código seguro, rápido y sin interrupciones para tus usuarios.',
                'description'       => 'Transformamos tu proceso de desarrollo con prácticas DevOps modernas. Configuramos pipelines de CI/CD, automatizamos pruebas, estandarizamos entornos con contenedores y reducimos el tiempo de despliegue de semanas a horas. Menos bugs en producción, más confianza en cada release.',
                'icon'              => 'heroicon-o-rocket-launch',
                'features'          => [
                    ['feature' => 'Pipelines CI/CD con GitHub Actions o GitLab CI'],
                    ['feature' => 'Contenedores Docker y orquestación con Kubernetes'],
                    ['feature' => 'Testing automatizado en cada commit'],
                    ['feature' => 'Rollback automático ante fallos en producción'],
                    ['feature' => 'Reducción de tiempo de deploy de semanas a horas'],
                ],
                'order'  => 6,
                'result' => 'Deploy en horas, no semanas',
            ],
        ];

        foreach ($services as $data) {
            unset($data['result']); // solo era referencia visual

            Service::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                array_merge($data, [
                    'slug'         => Str::slug($data['title']),
                    'status'       => ContentStatus::Published,
                    'published_at' => now(),
                    'created_by'   => $admin?->id ?? 1,
                    'approved_by'  => $admin?->id ?? 1,
                ])
            );
        }

        $this->command->info('✓ 6 servicios creados y publicados.');
    }
}
