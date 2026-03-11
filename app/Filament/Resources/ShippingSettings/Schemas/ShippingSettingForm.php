<?php

namespace App\Filament\Resources\ShippingSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShippingSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('price')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->prefix('$'),
            ]);
    }
}
