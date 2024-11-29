<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{Group, Section, TextEntry, RepeatableEntry, ImageEntry};
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Ангилал';

    protected static ?string $navigationBadgeTooltip = 'Нийт англиалын тоо';

    protected static ?string $navigationGroup = 'Бүтээгдэхүүн';

    protected static ?string $breadcrumb = 'Ангилал';

    protected static ?int $navigationSort = 3;

    public static ?string $label = 'Ангилал';

    public static ?string $pluralModelLabel = 'Ангилалууд';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Ангилалын нэр')
                            ->weight(FontWeight::Bold)
                            ->size(TextEntry\TextEntrySize::Large),
                    ]),
                RepeatableEntry::make('products')
                    ->label('Ангилалд хамрагдах бүтээгдэхүүн')
                    ->schema([
                        Group::make()
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Бүтээгдэхүүний нэр')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextEntry\TextEntrySize::Large),
                                TextEntry::make('description')
                                    ->label('Дэлгэрэнгүй мэдээлэл')
                                    ->weight(FontWeight::Medium),
                                ImageEntry::make('image')
                                    ->hiddenLabel()
                                    ->size(100),
                            ]),
                        Group::make()
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Үнэ')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->iconColor('success')
                                    ->weight(FontWeight::Bold)
                                    ->size(TextEntry\TextEntrySize::Large)
                                    ->color('success'),
                                TextEntry::make('quantity')
                                    ->label('Тоо ширхэг')
                                    ->icon('heroicon-o-cube')
                                    ->weight(FontWeight::Medium),
                                TextEntry::make('is_active')
                                    ->label('Төлөв')
                                    ->badge()
                                    ->weight(FontWeight::Medium),
                            ])->columns(3),
                    ])->columnSpanFull(),
            ]);
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
