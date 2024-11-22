<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

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
            ->body('Ангилалын мэдээллийг амжилттай шинэчиллээ');
    }

    public static ?string $title = 'Ангилалын мэдээллийг шинэчлэх';

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
