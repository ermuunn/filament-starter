<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\{ Section, TextInput };
class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected static ?string $breadcrumb = "Үүсгэх";

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Үүсгэх');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Дахин үүсгэх');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Цуцлах');
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Амжилттай үүсгэлээ')
            ->body('Хэрэглэгчийг амжилтаай үүсгэлээ');
    }

    public static ?string $title = 'Шинэ хэрэглэгч үүсгэх';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->description('Хэрэглэгчийн овог нэр, холбоо барих зэрэг ерөнхий мэдээлэл')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Нэр')
                            ->required()
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('last_name')
                            ->label('Овог')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('password')
                            ->label('Нууц үг')
                            ->password()
                            ->minLength(6)
                            ->revealable()
                            ->prefixIcon('heroicon-o-key')
                            ->required()
                            ->helperText('Нууц үг нь хамгийн багадаа 6 тэмдэгтээс бүрдэх ёстой')
                            ->hiddenOn(['view'])
                            ->columnSpanFull(),
                        TextInput::make('phone_number')->unique()
                            ->label('Утасны дугаар')
                            ->tel()
                            ->prefixIcon('heroicon-o-phone')
                            ->mask('99999999')
                            ->required(),
                        TextInput::make('email')->unique()
                            ->label('И-мэйл')
                            ->email()
                            ->prefixIcon('heroicon-o-at-symbol')
                            ->required(),
                        TextInput::make('address')
                            ->label('Хаяг')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
