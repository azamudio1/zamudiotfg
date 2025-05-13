<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('coupon_id')
                    ->label('Cupón aplicado')
                    ->relationship('coupon', 'code')
                    ->searchable()
                    ->nullable(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->step(0.01)
                    ->required(),

                Forms\Components\Select::make('payment_method')
                    ->label('Método de pago')
                    ->options([
                        'paypal' => 'PayPal',
                        'stripe' => 'Stripe',
                        'cash_on_delivery' => 'Contra reembolso',
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Estado del pedido')
                    ->options([
                        'pending' => 'Pendiente',
                        'processing' => 'Procesando',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('shipping_address')
                    ->label('Dirección de envío')
                    ->rows(3)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('user.email')->label('Usuario')->searchable(),
                Tables\Columns\TextColumn::make('coupon.code')->label('Cupón')->default('-'),
                Tables\Columns\TextColumn::make('total')->money('EUR')->label('Total'),
                Tables\Columns\TextColumn::make('payment_method')->label('Pago'),
                Tables\Columns\TextColumn::make('status')->label('Estado'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
