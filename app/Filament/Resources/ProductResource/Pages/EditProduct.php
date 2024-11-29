<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\{Checkbox, FileUpload, Group, Section, TextInput};

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

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
            ->body('Бүтээгдэхүүний мэдээллийг амжилттай шинэчиллээ');
    }

    public static ?string $title = 'Бүтээгдэхүүний мэдээллийг шинэчлэх';

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
                                    ->prefix('₮'),
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
