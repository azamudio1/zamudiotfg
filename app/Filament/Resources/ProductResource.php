<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Precio (€)')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Toggle::make('featured')
                    ->label('Destacado')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Precio')->money('EUR')->sortable(),
                Tables\Columns\TextColumn::make('stock')->label('Stock')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Categoría')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('featured')->label('Destacado')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->dateTime(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('featured')->label('¿Destacado?'),
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
        return [
            // Aquí puedes poner un RelationManager para imágenes o variantes
        ];
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
