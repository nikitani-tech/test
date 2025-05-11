<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use App\Models\Product;
use App\Models\User;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditOrders extends EditRecord
{
    protected static string $resource = OrdersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $orderTotal = 0;
        foreach ($this->data['items'] as $item) {
            $orderTotal = $orderTotal + $item['item_total'];
        }
        $data['order_total'] = $orderTotal;
        return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('order_status')
                    ->label('Order Status')
                    ->options([
                        'new' => 'New',
                        'in_process' => 'In Process',
                        'done' => 'Done',
                    ])->required(),

                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash on delivery',
                        'online_payment' => 'Online payment',
                    ])->required(),

                Select::make('delivery_method')
                    ->label('Delivery Method')
                    ->options([
                        'pickup' => 'Pickup',
                        'mail' => 'Delivery by mail',
                    ])->required(),

                Select::make('order_creator')
                    ->label('Order Creator')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->options(fn () => User::pluck('name', 'id')->toArray()),
                Repeater::make('items')
                    ->schema([
                        Select::make('product_id')
                            ->options(fn () => Product::pluck('product_name', 'id')->toArray())
                            ->label('Item Product')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('item_price', Product::find($state)?->price ?? 0);
                                $set('item_quantity', 1);
                                $set('item_total', Product::find($state)?->price ?? 0);
                            }),

                        TextInput::make('item_quantity')
                            ->label('Item Quantity')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('item_total', number_format($state * ($get('item_price') ?? 0), 2, '.', ''));
                            }),


                        TextInput::make('item_price')
                            ->formatStateUsing(fn ($state, $record) => Product::find($record->product_id)->price)
                            ->label('Item Price')
                            ->readOnly(),
                        TextInput::make('item_total')
                            ->label('Item Total')
                            ->readOnly(),
                    ])->columns(5)->relationship('items'),
            ])->columns(1);
    }
}
