<?php

namespace App\Livewire;

use App\Models\Product;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class CustomLayout extends Component implements HasForms, HasTable, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithInfolists;

    public Product $record;

    public ?array $data = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
    ];

    public function mount(Product $productId): void
    {
        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Бүтээгдэхүүний нэр')
                    ->required(),
                TextInput::make('description')
                    ->label('Дэлгэрэнгүй мэдээлэл'),
                TextInput::make('price')
                    ->label('Үнэ')
                    ->required(),
                TextInput::make('quantity')
                    ->label('Тоо ширхэг')
                    ->required(),
                TextInput::make('category.name')
                    ->label('Ангилал')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
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
                TextColumn::make('price')
                    ->label('Үнэ')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Тоо ширхэг')
                    ->sortable(),
            ])
            ->striped()
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema([
                Section::make('Ерөнхий мэдээлэл')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Бүтээгдэхүүний нэр'),
                        TextEntry::make('description')
                            ->label('Дэлгэрэнгүй мэдээлэл'),
                        TextEntry::make('price')
                            ->label('Үнэ'),
                        TextEntry::make('quantity')
                            ->label('Тоо ширхэг'),
                        TextEntry::make('category.name')
                            ->label('Ангилал'),
                    ])
            ]);
    }

    public function render()
    {
        return view('livewire.custom-layout');
    }
}
