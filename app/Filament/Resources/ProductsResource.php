<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class ProductsResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-m-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('price')
                    ->prefix('₴')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0),

                RichEditor::make('description'),

                SpatieMediaLibraryFileUpload::make('product_image')
                    ->label('Product Image')
                    ->disk('media')
                    ->collection('product_image')
                    ->required(),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->step(1)
                    ->default(1)
                    ->minValue(0),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('ID'),
                SpatieMediaLibraryImageColumn::make('details.Image')
                    ->collection('product_image')
                    ->label('Image')
                    ->square(),
                Tables\Columns\TextColumn::make('product_name')->sortable()->label('Product Name'),
                Tables\Columns\TextColumn::make('sku')->sortable()->label('SKU'),
                Tables\Columns\TextColumn::make('price')->sortable()->label('Price'),
                Tables\Columns\TextColumn::make('created_at')->sortable()->label('Created'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
