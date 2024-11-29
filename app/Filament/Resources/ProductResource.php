<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Livewire\CustomLayout;
use App\Models\Product;
use Faker\Provider\Text;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Livewire;
use Nette\Utils\Image;
use Filament\Infolists\Components\{Group, ImageEntry, Section, TextEntry};
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Бүтээгдэхүүн';

    protected static ?string $navigationBadgeTooltip = 'Нийт бүтээгдэхүүний тоо';

    protected static ?string $navigationGroup = 'Бүтээгдэхүүн';

    protected static ?string $breadcrumb = 'Бүтээгдэхүүн';

    protected static ?int $navigationSort = 2;

    public static ?string $label = 'Бүтээгдэхүүн';

    public static ?string $pluralModelLabel = 'Бүтээгдэхүүнүүд';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Livewire::make(CustomLayout::class)->columnSpan(12),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
