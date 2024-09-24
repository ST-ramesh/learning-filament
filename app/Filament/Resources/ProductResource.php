<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Models\Product;
use App\Models\Products;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->required(),
            TextInput::make('price')->numeric()->required(),
            Textarea::make('description')->nullable(),
            Toggle::make('status')
                ->label('Active')
                ->default(true),
            FileUpload::make('images')
                ->image()
                ->multiple()
                ->enableReordering()
                ->maxSize(5120) // 5MB
                ->acceptedFileTypes(['image/jpg','image/jpeg', 'image/png'])
                ->directory('product-images') // Define directory for uploads
                ->columnSpan('full'), // Span the full width of the form
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name'),
            TextColumn::make('price')->money('usd', true),
            BooleanColumn::make('status')->label('Active'),
        ]);
    }   

    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class, // Register the ImagesRelationManager here
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
