<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class LoginCustom extends BaseLogin
{
    // Ubah judul/heading kalau mau
    public function getTitle(): string|Htmlable
    {
        return 'Masuk ke Dashboard';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Silakan masuk';
    }

    // Contoh kustomisasi field email
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->placeholder('you@example.com')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    // Contoh kustomisasi field password
    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Kata sandi')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    // (Opsional) kalau mau login pakai username, ganti kredensial di sini
    // protected function getCredentialsFromFormData(array $data): array
    // {
    //     return [
    //         'username' => $data['username'],
    //         'password' => $data['password'],
    //     ];
    // }
}
