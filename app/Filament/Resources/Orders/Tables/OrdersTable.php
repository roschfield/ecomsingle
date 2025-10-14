<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('Order #'),
                TextColumn::make('user.name')->label('Customer')->searchable(),
                TextColumn::make('grand_total')->money('USD', true)->sortable(),
                TextColumn::make('payment_status')
                    ->colors([
                        'success' => 'paid',
                        'warning' => 'pending',
                        'danger' => 'failed',
                    ]),
                TextColumn::make('status')
                    ->colors([
                        'primary' => 'new',
                        'success' => 'delivered',
                        'warning' => 'processing',
                    ]),
                TextColumn::make('created_at')->dateTime()->label('Date')->sortable(),
            ])
            
            
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
