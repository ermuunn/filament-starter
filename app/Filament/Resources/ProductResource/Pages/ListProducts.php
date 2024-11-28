<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Enum\Product\Status;
use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\{ ActionGroup, ViewAction, EditAction, DeleteAction };
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected static ?string $breadcrumb = "Жагсаалт";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Бүтээгдэхүүн шинээр нэмэх')
                ->icon('heroicon-m-plus'),
        ];
    }

    protected array $statusCounts = [];
    public function getRequestStatusCounts(): array
    {
        return DB::table('products')
            ->select('is_active', DB::raw('count(*) as statusCount'))
            ->groupBy('is_active')
            ->pluck('statusCount', 'is_active')
            ->toArray();
    }

    public function getTabs(): array
    {
        $this->statusCounts = $this->getRequestStatusCounts();

        return [
            'all' => Tab::make('Бүгд')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query;
                })
                ->badge(array_sum($this->statusCounts)),
            'active' => Tab::make(Status::Active->getLabel())
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('is_active', Status::Active->value);
                })
                ->badge($this->statusCounts[Status::Active->value] ?? 0)
                ->badgeColor('success'),
            'inactive' => Tab::make(Status::Inactive->getLabel())
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('is_active', Status::Inactive->value);
                })
                ->badge($this->statusCounts[Status::Inactive->value] ?? 0)
                ->badgeColor('danger'),
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
                    ->label('Бүтээгдэхүүний нэр')
                    ->extraAttributes(['class' => 'font-semibold'])
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Дэлгэрэнгүй мэдээлэл')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Ангилал')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Зураг'),
                TextColumn::make('price')
                    ->label('Үнэ')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Тоо ширхэг')
                    ->sortable(),
                TextColumn::make('is_active')
                    ->label('Төлөв')
                    ->badge(),
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
                            ->modalHeading('Бүтээгдэхүүн устгах')
                            ->modalDescription('Та уг бүтээгдэхүүнийг устгахдаа итгэлтэй байна уу?')
                            ->modalSubmitActionLabel('Устгах')
                            ->modalCancelActionLabel('Цуцлах'),
                    ])->dropdown(false),
                ])->dropdownPlacement('bottom-start'),
            ]);
    }
}
