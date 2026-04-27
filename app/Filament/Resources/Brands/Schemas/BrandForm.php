<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_en')
                    ->required(),
                TextInput::make('name_ar')
                    ->required(),
                 FileUpload::make('image')
                    ->label('Brand Image')
                    ->disk('public')            
                    ->directory('brands')    
                    ->image()                    
                    ->default('brands/default.png')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                     ->required()
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ]),
            ]);
    }
}
