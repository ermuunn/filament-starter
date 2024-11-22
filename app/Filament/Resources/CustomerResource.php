<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{ Section, TextEntry };
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Хэрэглэгч';

    protected static ?string $navigationBadgeTooltip = 'Нийт хэрэглэгчдийн тоо';

    protected static ?string $navigationGroup = 'Хэрэглэгч';

    protected static ?string $breadcrumb = 'Хэрэглэгч';

    protected static ?int $navigationSort = 1;

    public static ?string $label = 'Хэрэглэгч';

    public static ?string $pluralModelLabel = 'Хэрэглэгчид';

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
                        TextEntry::make('last_name')
                            ->label('Овог')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        TextEntry::make('first_name')
                            ->label('Нэр')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        TextEntry::make('phone_number')
                            ->label('Утас')
                            ->icon('heroicon-o-phone')
                            ->iconColor('gray')
                            ->weight(FontWeight::Medium)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1500),
                        TextEntry::make('email')
                            ->label('И-мэйл')
                            ->icon('heroicon-o-at-symbol')
                            ->iconColor('gray')
                            ->weight(FontWeight::Medium)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1500),
                        TextEntry::make('address')
                            ->label('Хаяг')
                            ->icon('heroicon-o-map-pin')
                            ->iconColor('gray')
                            ->weight(FontWeight::Medium)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1500)
                            ->columnSpanFull(),
                    ])->columns(2),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
