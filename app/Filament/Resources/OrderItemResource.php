<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Items de Pedido';
    protected static ?string $pluralLabel = 'Items de Pedido';
    protected static ?string $modelLabel = 'Item de Pedido';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->label('Pedido')
                    ->relationship('order', 'id')
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('product_id')
                    ->label('Producto')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Precio')
                    ->numeric()
                    ->step(0.01)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.id')->label('Pedido')->sortable(),
                Tables\Columns\TextColumn::make('product.name')->label('Producto')->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Cantidad'),
                Tables\Columns\TextColumn::make('price')->label('Precio')->money('EUR'),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->dateTime(),
            ])
            ->filters([
                //
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
