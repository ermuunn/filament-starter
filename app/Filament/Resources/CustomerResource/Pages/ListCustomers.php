<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\{ ActionGroup, ViewAction, EditAction, DeleteAction };
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected static ?string $breadcrumb = "Жагсаалт";

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Хэрэглэгч шинээр бүртгэх')
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
                TextColumn::make('full_name')
                    ->label('Овог нэр')
                    ->extraAttributes(['class' => 'font-semibold'])
                    ->searchable('first_name'),
                TextColumn::make('phone_number')
                    ->label('Холбоо барих')
                    ->description(fn (Customer $record): string => $record->email)
                    ->searchable()
                    ->copyable(),
                TextColumn::make('address')
                    ->label('Хаяг')
                    ->limit(40)
                    ->searchable(),
            ])
            ->searchOnBlur()
            ->persistSearchInSession()
            ->striped()
            ->filters([
                //
            ])
            ->emptyStateHeading('Хэрэглэгч олдсонгүй')
            ->emptyStateDescription('Шинээр бүртгэсэн хэрэглэгчид энд харагдана.')
            ->emptyStateIcon('heroicon-s-user-group')
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->icon('heroicon-o-eye')
                        ->label('Үзэх'),
                    EditAction::make()
                        ->icon('heroicon-o-cog-6-tooth')
                        ->label("Засах"),
                    Action::make('changePassword')
                        ->icon('heroicon-o-key')
                        ->label('Нууц үг солих')
                        ->modalSubmitActionLabel('Хадгалах')
                        ->modalCancelActionLabel('Цуцлах')
                        ->form([
                            TextInput::make('new_password')
                                ->label('Шинэ нууц үг')
                                ->password()
                                ->required()
                                ->minLength(6)
                                ->helperText('Нууц үг нь хамгийн багадаа 6 тэмдэгтээс бүрдэх ёстой'),
                            TextInput::make('new_password_confirmation')
                                ->label('Шинэ нууц үг давтах')
                                ->password()
                                ->required()
                                ->same('new_password')
                                ->validationMessages([
                                    'same' => 'Давтсан нууц үг нь шинэ нууц үгтэй ижил байх ёстой.',
                                ]),
                        ])
                        ->action(function ($data, $record) {
                            $record->update([
                                'password' => Hash::make($data['new_password']),
                            ]);
                            Notification::make()
                                ->title('Амжилттай')
                                ->body('Хэрэглэгчийн нууц үг амжилттай солигдлоо')
                                ->success()
                                ->send();
                        }),
                    ActionGroup::make([
                        DeleteAction::make()
                            ->icon('heroicon-o-trash')
                            ->label('Устгах')
                            ->modalHeading('Хэрэглэгч устгах')
                            ->modalDescription('Та уг хэрэглэгчийг устгахдаа итгэлтэй байна уу?')
                            ->modalSubmitActionLabel('Устгах')
                            ->modalCancelActionLabel('Цуцлах'),
                    ])->dropdown(false),
                ])->dropdownPlacement('bottom-start'),
            ])
            ->bulkActions([
            ]);
    }
}
