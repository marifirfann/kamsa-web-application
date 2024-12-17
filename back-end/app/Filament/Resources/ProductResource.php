<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxLength(10),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxLength(5),

                Forms\Components\FileUpload::make('product_image')
                    ->label('Product Image')
                    ->image()
                    ->nullable() // Kolom gambar bisa kosong
                    ->disk('public') // Tentukan disk penyimpanan untuk file
                    ->directory('products') // Tentukan folder penyimpanan
                    ->rules('image|max:6144'), // Validasi untuk gambar
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50), // Batasi panjang deskripsi yang ditampilkan

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('id'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock'),

                Tables\Columns\ImageColumn::make('product_image')
                    ->label('Product Image')
                    ->disk('public')
                    ->default('placeholder.jpg'), // Menampilkan gambar placeholder jika tidak ada gambar
            ])
            ->filters([
                // Menambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
