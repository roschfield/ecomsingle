<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                  Section::make('Product Information')->schema([
                     TextInput::make('name')
                       ->required()
                       ->maxLength(255)
                       ->live(onBlur:true)
                       ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)):null),
                  
                     TextInput::make('slug')
                      ->required()
                      ->maxLength(255)
                      ->disabled()
                      ->dehydrated()
                      ->unique(Product::class,'slug', ignoreRecord:true),
                     MarkdownEditor::make('description')
                      ->columnSpanFull()
                      ->default(null)
                  ])->columns(2),
                  Section::make('Image')->schema([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('products'),
                  ]),

                ])->columnSpan(2),

                Group::make()->schema([
                     Section::make('Price')->schema([
                        TextInput::make('price')
                         ->required()
                         ->numeric()
                         ->prefix('BDT'),
                     ]),
                     Section::make('Price')->schema([
                        Select::make('category_id')
                         ->required()
                         ->searchable()
                         ->preload()
                         ->relationship('category','name'),
                        Select::make('collection_id')
                         ->required()
                         ->searchable()
                         ->preload()
                         ->relationship('collection','name')
                     ]),
                     Section::make('Status')->schema([
                           Toggle::make('is_active')
                            ->required()
                            ->default(true),
                          Toggle::make('in_stock')
                             ->required()
                             ->default(true),
                     ]),
                     Section::make('Price')->schema([
                        TextInput::make('stock_quantity')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
                     ])
                ])->columnSpan(1),
            ])->columns(3);
    }
}
