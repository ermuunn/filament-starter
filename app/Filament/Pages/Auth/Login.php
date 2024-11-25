<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.email' => 'Цахим шуудан эсвэл нууц үг буруу байна.',
        ]);
    }

    protected function getRateLimitedNotification(TooManyRequestsException $exception): ?Notification
    {
        return Notification::make()
            ->title(__('Нэвтрэх эрх түр хугацаанд хязгаарлагдлаа', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => $exception->minutesUntilAvailable,
            ]))
            ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('Та буруу бүртгэлээр олон удаа нэвтэрсэн тул :seconds секундын дараа дахин оролдож үзнэ үү.', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => $exception->minutesUntilAvailable,
            ]) : null)
            ->danger();
    }

    protected function getAuthenticateFormAction(): Action
    {
        return Action::make('authenticate')
            ->label('Нэвтрэх')
            ->submit('authenticate');
    }

    public function getTitle(): string|Htmlable
    {
        return 'Нэвтрэх';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Нэвтрэх';
    }

    public function registerAction(): Action
    {
        return Action::make('register')
            ->link()
            ->label('Бүртгүүлэх')
            ->url(filament()->getRegistrationUrl());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent()->label('Цахим шуудан'),
                $this->getPasswordFormComponent()->label('Нууц үг'),
                $this->getRememberFormComponent()->label('Намайг сана'),
            ])
            ->statePath('data');
    }
}
