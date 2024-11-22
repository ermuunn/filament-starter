<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\{ Section, TextInput };

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected static ?string $breadcrumb = "Засах";

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Хадгалах');
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()
            ->label('Цуцлах');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Устгах'),
        ];
    }

    protected function getUpdatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Амжилттай шинэчлэгдлээ')
            ->body('Хэрэглэгчийн мэдээллийг амжилттай шинэчиллээ');
    }

    public static ?string $title = 'Хэрэглэгчийн мэдээллийг шинэчлэх';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->description('Ажилтны овог нэр, холбоо барих зэрэг ерөнхий мэдээлэл')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Нэр')
                            ->required()
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('last_name')
                            ->label('Овог')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('phone_number')->unique(ignoreRecord: true)
                            ->label('Утасны дугаар')
                            ->tel()
                            ->prefixIcon('heroicon-o-phone')
                            ->required(),
                        TextInput::make('email')->unique(ignoreRecord: true)
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
