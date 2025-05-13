<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Cupones';
    protected static ?string $pluralModelLabel = 'Cupones';
    protected static ?string $modelLabel = 'Cupón';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Código')
                    ->required()
                    ->unique(ignoreRecord: true),  

                Forms\Components\TextInput::make('discount')
                    ->label('Descuento (%)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100),  

                Forms\Components\DatePicker::make('valid_from')
                    ->label('Válido desde')
                    ->required(),

                Forms\Components\DatePicker::make('valid_until')
                    ->label('Válido hasta')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('code')->label('Código')->sortable(),
                Tables\Columns\TextColumn::make('discount')->label('Descuento (%)')->sortable(),
                Tables\Columns\TextColumn::make('valid_from')->label('Válido desde')->dateTime(),
                Tables\Columns\TextColumn::make('valid_until')->label('Válido hasta')->dateTime(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Activo'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Creado'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Actualizado'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Estado')
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos'),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
