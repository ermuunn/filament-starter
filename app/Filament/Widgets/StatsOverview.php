<?php

namespace App\Filament\Widgets;

use App\Models\{ Customer, Product, Category };
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make('Хэрэглэгчид', Customer::query()->count())
                ->description('Нийт хэрэглэгчдийн тоо')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Ангилал', Category::query()->count())
                ->description('Ангилалын тоо')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([3, 3, 3, 3, 3, 3, 3])
                ->color('info'),
            Stat::make('Бүтээгдэхүүнүүд', Product::query()->count())
                ->description('Нийт бүтээгдэхүүний тоо')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
        ];
    }
}
