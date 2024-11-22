<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\{Checkbox, FileUpload, Group, Section, TextInput };
class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

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
            ->body('Бүтээгдэхүүнийг амжилтаай үүсгэлээ');
    }

    public static ?string $title = 'Шинэ бүтээгдэхүүн үүсгэх';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->description('Бүтээгдэхүүний нэр, үнэ зэрэг ерөнхий мэдээлэл')
                    ->schema([
                        TextInput::make('name')
                            ->label('Бүтээгдэхүүний нэр')
                            ->required()
                            ->prefixIcon('heroicon-o-cube'),
                        TextInput::make('description')
                            ->label('Дэлгэрэнгүй мэдээлэл')
                            ->prefixIcon('heroicon-o-information-circle'),
                       Group::make()
                            ->schema([
                                TextInput::make('price')
                                    ->label('Үнэ')
                                    ->required()
                                    ->prefixIcon('heroicon-o-currency-dollar'),
                                TextInput::make('quantity')
                                    ->label('Тоо ширхэг')
                                    ->required()
                                    ->prefixIcon('heroicon-o-cube'),
                                Checkbox::make('Төлөв')
                                    ->label('Идэвхтэй эсэх')
                                    ->default(true)
                                    ->inline(false),
                            ])->columns(3),
                    ])->columnSpan(8),
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Зураг')
                            ->image()
                            ->imageEditor()
                            ->imageResizeTargetWidth('200')
                            ->imageResizeTargetHeight('200')
                            ->directory('products')
                            ->uploadingMessage('Зургийг уншиж байна...'),
                    ])->columnSpan(4),
            ])->columns(12);
    }
}
