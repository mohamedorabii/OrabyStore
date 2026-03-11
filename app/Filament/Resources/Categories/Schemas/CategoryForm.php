<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class CategoryForm
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
                    ->label('Category Image')
                    ->disk('public')             // الصور تروح في storage/app/public
                    ->directory('categories')    // فولدر فرعي باسم categories
                    ->image()                     // يتحقق إنها صورة                // اختياري
                    ->default('categories/default.png') // صورة افتراضية لو فاضي
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ])
                    ->default(1)
                    ->required()
            ]);
    }
}
