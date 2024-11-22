<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\{ Section, TextInput };

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

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
            ->body('Ангилалыг амжилтаай үүсгэлээ');
    }

    public static ?string $title = 'Шинэ ангилал үүсгэх';

    public function form (Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->schema([
                        TextInput::make('name')
                            ->label('Ангилалын нэр')
                            ->required()
                            ->prefixIcon('heroicon-o-cube'),
                    ]),
            ]);
    }
}
