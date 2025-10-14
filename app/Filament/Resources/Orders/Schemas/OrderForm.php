<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('stripe_payment_id')
                    ->default(null),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('grand_total')
                    ->numeric()
                    ->default(null),
                TextInput::make('payment_method')
                    ->default(null),
                TextInput::make('payment_status')
                    ->default(null),
                Select::make('status')
                    ->options([
            'new' => 'New',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delieverd' => 'Delieverd',
            'canceled' => 'Canceled',
        ])
                    ->default('new')
                    ->required(),
                TextInput::make('currency')
                    ->default(null),
                TextInput::make('shipping_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('shipping_method')
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
