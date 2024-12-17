<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn; // Import ImageColumn untuk menampilkan gambar

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    // Form schema untuk create atau edit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('program_name')
                    ->label('Program Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(500),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxLength(10),

                // Field untuk upload gambar
                Forms\Components\FileUpload::make('image')
                    ->label('Program Image')
                    ->image() // Menambahkan validasi untuk gambar
                    ->disk('public') // Menyimpan gambar di storage/public
                    ->directory('program_images') // Menyimpan gambar dalam folder program_images
                    ->nullable(),
            ])
            ->columns(1);
    }

    // Table schema untuk index
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program_name')
                    ->label('Program Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('id'), // Format uang sesuai dengan IDR

                // Kolom untuk menampilkan gambar thumbnail
                ImageColumn::make('image')
                    ->label('Program Image')
                    ->disk('public') // Menampilkan gambar dari disk public
                    ->width(50)
                    ->height(50),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                // Tindakan seperti edit
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Bulk actions seperti delete
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Jika ada relations bisa didefinisikan di sini
    public static function getRelations(): array
    {
        return [];
    }

    // Definisikan halaman yang ada (index, create, edit)
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
