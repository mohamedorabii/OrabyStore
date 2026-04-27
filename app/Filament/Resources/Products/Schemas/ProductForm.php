<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_en')
                    ->required(),
                TextInput::make('name_ar')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->minValue(1)
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('code')
                    ->unique()
                    ->required(),
                FileUpload::make('image')
                    ->label('Product Image')
                    ->disk('public')
                    ->directory('products')
                    ->image()
                    ->default('products/default.png')
                    ->required(),
                Textarea::make('desc_en')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('desc_ar')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ]),
                Select::make('subcategory_id')
                    ->label('Subcategory')
                    ->relationship('subcategory', 'name_en')
                    ->default(null),
                Select::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name_en')
                    ->default(null),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name_en')
                    ->required()
            ]);
    }
}
