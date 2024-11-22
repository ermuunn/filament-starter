<?php

namespace App\Enum\Product;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Status: int implements HasLabel, HasColor, HasIcon
{
    case Inactive = 0;
    case Active = 1;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Inactive => 'Идэвхгүй',
            self::Active => 'Идэвхтэй',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Inactive => 'danger',
            self::Active => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Inactive => 'heroicon-o-x-circle',
            self::Active => 'heroicon-o-check-circle',
        };
    }
}
