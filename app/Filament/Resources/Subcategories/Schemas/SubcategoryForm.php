<?php

namespace App\Filament\Resources\Subcategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class SubcategoryForm
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
                    ->label('Subcategory Image')
                    ->disk('public')            
                    ->directory('subcategories')    
                    ->image()           
                    ->deletable()          
                    ->default('subcategories/default.png')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ])
                    ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name_en')
                    ->required()
            ]);
    }
}
