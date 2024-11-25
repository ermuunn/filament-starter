<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseAuth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class Register extends BaseAuth
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

    public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->label('Бүртгүүлэх')
            ->submit('register');
    }

    public function loginAction(): Action
    {
        return Action::make('login')
            ->link()
            ->label('Нэвтрэх')
            ->url(filament()->getLoginUrl());
    }

    public function getTitle(): string|Htmlable
    {
        return 'Бүртгүүлэх';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Бүртгүүлэх';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent()->label('Нэр'),
                $this->getEmailFormComponent()->label('Цахим шуудан'),
                $this->getPasswordFormComponent()->label('Нууц үг'),
                $this->getPasswordConfirmationFormComponent()->label('Нууц үг давтах'),
            ])
            ->statePath('data');
    }
}
