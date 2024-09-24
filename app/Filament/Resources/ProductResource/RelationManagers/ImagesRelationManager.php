<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagesRelationManager extends RelationManager 
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('path') 
                ->label('Product Image')
                ->image() 
                ->maxSize(5120)
                ->acceptedFileTypes(['image/jpg','image/jpeg', 'image/png'])
                ->directory('product-images') 
                ->required(), 
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('images')
            ->columns([
                Tables\Columns\TextColumn::make('images'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
