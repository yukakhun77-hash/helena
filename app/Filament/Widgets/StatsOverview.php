<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Jumlah semua produk di database')
                ->icon('heroicon-o-cube'),

            Stat::make('Produk Baru Bulan Ini', Product::whereMonth('created_at', now()->month)->count())
                ->description('Ditambahkan bulan ini')
                ->icon('heroicon-o-plus'),

            Stat::make('Rata-rata Harga', 'Rp ' . number_format(Product::avg('price'), 0, ',', '.'))
                ->description('Harga rata-rata produk')
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
}
