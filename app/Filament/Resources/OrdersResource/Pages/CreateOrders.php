<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Form;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $orderTotal = 0;
        foreach ($this->data['items'] as $item) {
            $orderTotal = $orderTotal + $item['item_total'];
        }
        $data['order_total'] = $orderTotal;
        $data['billing_info'] = json_encode([
            'billing_first_name' => $this->data['billing_first_name'],
            'billing_last_name' => $this->data['billing_last_name'],
            'billing_street_address' => $this->data['billing_street_address'],
            'billing_city' => $this->data['billing_city'],
            'billing_zip' => $this->data['billing_zip'],
            'billing_phone' => $this->data['billing_phone'],
            'billing_email' => $this->data['billing_email'],
        ]);
        return $data;
    }

    public function form(Form|\Filament\Forms\Form $form): \Filament\Forms\Form
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
                            ->label('Item Product')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->options(fn () => Product::pluck('product_name', 'id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('item_price', Product::find($state)?->price ?? 0);
                            }),
                        TextInput::make('item_quantity')
                            ->label('Item Quantity')
                            ->numeric()
                            ->minValue(0)
                            ->step(1)
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $set('item_total', number_format($state * ($get('item_price') ?? 0), 2, '.', ''));
                            }),

                        TextInput::make('item_price')
                            ->label('Item Price')
                            ->readOnly(),
                        TextInput::make('item_total')
                            ->label('Item Total')
                            ->readOnly(),
                    ])->columns(5)->relationship('items'),

                Section::make('User Information')
                    ->schema([
                        Section::make('Billing Info')->schema([
                            Actions::make([
                                Action::make('randBillingInfo')
                                    ->icon('heroicon-c-pencil')
                                    ->label('Generate Random Billing Info')
                                    ->action(function (callable $set) {
                                        $faker = Factory::create();
                                        $set('billing_first_name', $faker->firstName);
                                        $set('billing_last_name', $faker->lastName);
                                        $set('billing_street_address', $faker->streetAddress);
                                        $set('billing_city', $faker->city);
                                        $set('billing_zip', $faker->postcode);
                                        $set('billing_phone', $faker->e164PhoneNumber);
                                        $set('billing_email', $faker->email());
                                    })
                            ])->fullWidth(),
                            TextInput::make('billing_first_name')->label('Billing First Name')->required(),
                            TextInput::make('billing_last_name')->label('Billing Last Name')->required(),
                            TextInput::make('billing_street_address')->label('Billing Street Address')->required(),
                            TextInput::make('billing_city')->label('Billing City')->required(),
                            TextInput::make('billing_zip')->label('Billing ZIP')->required(),
                            TextInput::make('billing_phone')->label('Billing Phone')->required(),
                            TextInput::make('billing_email')->label('Billing Email')->email()->required(),
                        ])->columnSpan(1),
                    ]),
            ])->columns(1);


    }
}
