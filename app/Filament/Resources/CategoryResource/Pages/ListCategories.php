<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected static ?string $breadcrumb = "Жагсаалт";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ангилал шинээр үүсгэх')
                ->icon('heroicon-m-plus'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('Д/д'),
                TextColumn::make('name')
                    ->label('Ангилалын нэр')
                    ->extraAttributes(['class' => 'font-semibold'])
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('products.image')
                    ->label('Бүтээгдэхүүнүүд')
                    ->size(30)
                    ->circular()
                    ->stacked()
                    ->limit(10)
                    ->limitedRemainingText(),
            ])
            ->searchOnBlur()
            ->persistSearchInSession()
            ->striped()
            ->filters([
                //
            ])
            ->emptyStateHeading('Бүтээгдэхүүн олдсонгүй')
            ->emptyStateDescription('Шинээр нэмэгдсэн бүтээгдэхүүн энд харагдана.')
            ->emptyStateIcon('heroicon-s-cube')
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Үзэх'),
                    EditAction::make()
                        ->label('Засах'),
                    ActionGroup::make([
                        DeleteAction::make()
                            ->label('Устгах')
                            ->modalHeading('Ангилал устгах')
                            ->modalDescription('Та уг ангилалыг устгахдаа итгэлтэй байна уу?')
                            ->modalSubmitActionLabel('Устгах')
                            ->modalCancelActionLabel('Цуцлах'),
                    ])->dropdown(false),
                ])->dropdownPlacement('bottom-start'),
            ]);
    }
}
