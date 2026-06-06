<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Configuración';
    protected static ?string $navigationGroup = 'Configuración';
    protected static ?string $title = 'Configuración del sitio';
    protected static string $view = 'filament.pages.site-settings';
    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form->statePath('data')->schema([
            Forms\Components\Tabs::make('Configuración')->tabs([

                Forms\Components\Tabs\Tab::make('Hero')->schema([
                    Forms\Components\TextInput::make('hero_title')
                        ->label('Título principal')->required()->maxLength(100),
                    Forms\Components\TextInput::make('hero_subtitle')
                        ->label('Subtítulo')->maxLength(200),
                    Forms\Components\TextInput::make('hero_cta_text')
                        ->label('Texto del botón CTA')->default('Ver servicios'),
                    Forms\Components\TextInput::make('hero_cta_url')
                        ->label('URL del botón CTA')->default('#services'),
                    Forms\Components\TextInput::make('hero_secondary_cta_text')
                        ->label('Texto CTA secundario')->default('Ver proyectos'),
                ]),

                Forms\Components\Tabs\Tab::make('General')->schema([
                    Forms\Components\TextInput::make('site_name')->label('Nombre del sitio')->required(),
                    Forms\Components\Textarea::make('site_description')->label('Descripción del sitio')->rows(3),
                    Forms\Components\TextInput::make('contact_email')->label('Email de contacto')->email(),
                    Forms\Components\TextInput::make('contact_phone')->label('Teléfono')->tel(),
                    Forms\Components\TextInput::make('contact_address')->label('Dirección'),
                ]),

                Forms\Components\Tabs\Tab::make('Redes Sociales')->schema([
                    Forms\Components\TextInput::make('social_github')->label('GitHub')->url()->prefix('https://'),
                    Forms\Components\TextInput::make('social_linkedin')->label('LinkedIn')->url()->prefix('https://'),
                    Forms\Components\TextInput::make('social_twitter')->label('X / Twitter')->url()->prefix('https://'),
                    Forms\Components\TextInput::make('social_instagram')->label('Instagram')->url()->prefix('https://'),
                ]),

                Forms\Components\Tabs\Tab::make('Correo')->schema([
                    Forms\Components\Section::make('Servidor SMTP saliente')
                        ->description('Configuración para enviar emails desde el formulario de contacto.')
                        ->columns(2)
                        ->schema([
                            Forms\Components\TextInput::make('mail_host')
                                ->label('Host SMTP')->placeholder('mail.tudominio.com')->columnSpan(2),
                            Forms\Components\TextInput::make('mail_port')
                                ->label('Puerto')->placeholder('465')->numeric(),
                            Forms\Components\Select::make('mail_encryption')
                                ->label('Cifrado')
                                ->options(['smtps' => 'SSL (465)', 'tls' => 'TLS (587)', 'none' => 'Ninguno']),
                            Forms\Components\TextInput::make('mail_username')
                                ->label('Usuario / Email')->placeholder('tu@dominio.com')->columnSpan(2),
                            Forms\Components\TextInput::make('mail_password')
                                ->label('Contraseña')->password()->revealable()->columnSpan(2),
                            Forms\Components\TextInput::make('mail_from_address')
                                ->label('Dirección remitente')->email()->placeholder('noreply@tudominio.com'),
                            Forms\Components\TextInput::make('mail_from_name')
                                ->label('Nombre remitente')->placeholder('Mi Empresa'),
                        ]),
                    Forms\Components\Section::make('Destino de contacto')
                        ->schema([
                            Forms\Components\TextInput::make('mail_to')
                                ->label('Recibir formularios en')->email()->required()
                                ->helperText('Aquí llegarán los mensajes del formulario de contacto.'),
                        ]),
                ]),

                Forms\Components\Tabs\Tab::make('Secciones')->schema([
                    Forms\Components\TextInput::make('services_title')->label('Título sección Servicios')->default('Nuestros Servicios'),
                    Forms\Components\TextInput::make('projects_title')->label('Título sección Proyectos')->default('Proyectos'),
                    Forms\Components\TextInput::make('testimonials_title')->label('Título sección Testimonios')->default('Lo que dicen de nosotros'),
                    Forms\Components\TextInput::make('about_title')->label('Título sección Nosotros')->default('¿Por qué elegirnos?'),
                    Forms\Components\Textarea::make('about_text')->label('Texto sección Nosotros')->rows(4),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $groups = [
            'hero'   => ['hero_title', 'hero_subtitle', 'hero_cta_text', 'hero_cta_url', 'hero_secondary_cta_text'],
            'general'=> ['site_name', 'site_description', 'contact_email', 'contact_phone', 'contact_address'],
            'social' => ['social_github', 'social_linkedin', 'social_twitter', 'social_instagram'],
            'sections'=> ['services_title', 'projects_title', 'testimonials_title', 'about_title', 'about_text'],
            'mail'    => ['mail_host', 'mail_port', 'mail_encryption', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name', 'mail_to'],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key) {
                if (array_key_exists($key, $data)) {
                    SiteSetting::set($key, $data[$key], $group);
                }
            }
        }

        Notification::make()->title('Configuración guardada')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')->label('Guardar cambios')->submit('save'),
        ];
    }
}
