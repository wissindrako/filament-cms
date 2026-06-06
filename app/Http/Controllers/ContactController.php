<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'service' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required'    => 'El nombre es obligatorio.',
            'email.required'   => 'El email es obligatorio.',
            'email.email'      => 'Ingresa un email válido.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min'      => 'El mensaje debe tener al menos 10 caracteres.',
        ]);

        // Configurar SMTP desde los ajustes del admin
        $this->applyMailConfig();

        $to = SiteSetting::get('mail_to') ?? SiteSetting::get('contact_email') ?? config('mail.from.address');

        Mail::to($to)->send(new ContactFormMail($validated));

        return back()->with('contact_success', true);
    }

    private function applyMailConfig(): void
    {
        $map = [
            'mail_host'         => 'mail.mailers.smtp.host',
            'mail_port'         => 'mail.mailers.smtp.port',
            'mail_username'     => 'mail.mailers.smtp.username',
            'mail_password'     => 'mail.mailers.smtp.password',
            'mail_from_address' => 'mail.from.address',
            'mail_from_name'    => 'mail.from.name',
        ];

        foreach ($map as $settingKey => $configKey) {
            $value = SiteSetting::get($settingKey);
            if ($value !== null && $value !== '') {
                Config::set($configKey, $value);
            }
        }

        // scheme: 'smtps' (SSL/465), 'tls' (STARTTLS/587), null (sin cifrado)
        $encryption = SiteSetting::get('mail_encryption');
        if ($encryption !== null && $encryption !== '') {
            Config::set('mail.mailers.smtp.scheme', $encryption === 'none' ? null : $encryption);
        }
    }
}
