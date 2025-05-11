<?php

namespace App\Filament\Widgets;

use Database\Seeders\ProductSeeder;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class SeederWidget extends Widget
{
    protected static string $view = 'filament.widgets.seeder-widget';
    protected int|string|array $columnSpan = 'full';
    public int $productsCount = 10;
    public bool $addImage = false;
    public function runProductSeeder(): void
    {
        try {
            app()->call(ProductSeeder::class . '@run', [
                'productsCount' => $this->productsCount,
                'addImage' => $this->addImage,
            ]);
            Notification::make()
                ->title("Product seeder running successfully")
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title("Error seeding database")
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }
}
