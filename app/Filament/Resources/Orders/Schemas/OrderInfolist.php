<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('order_number'),
                TextEntry::make('status')
                   ->label('Status')
                    ->colors([
                        'primary' => 'pending',      
                        'info'    => 'shipped',     
                        'success' => 'delivered',  
                        'danger'  => 'cancelled',  
                    ]),
                TextEntry::make('shipping_price')
                    ->money(),
                TextEntry::make('name'),
                TextEntry::make('phone'),
                TextEntry::make('address'),
                TextEntry::make('city'),
                TextEntry::make('governorate'),
                TextEntry::make('total_price')
                    ->money(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
