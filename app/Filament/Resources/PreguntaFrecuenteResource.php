<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreguntaFrecuenteResource\Pages;
use App\Filament\Resources\PreguntaFrecuenteResource\RelationManagers;
use App\Models\PreguntaFrecuente;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PreguntaFrecuenteResource extends Resource
{
    protected static ?string $model = PreguntaFrecuente::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('categoria')->required(),
                TextInput::make('subcategoria')->required(),
                TextInput::make('pregunta')->required(),
                RichEditor::make('respuesta')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->sortable(),
                TextColumn::make('subcategoria')
                    ->label('Subcategoría')
                    ->sortable(),
                TextColumn::make('pregunta')
                    ->label('Pregunta')
                    ->sortable(),
                TextColumn::make('respuesta')
                    ->label('Respuesta')
                    ->limit(50)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPreguntaFrecuentes::route('/'),
            'create' => Pages\CreatePreguntaFrecuente::route('/create'),
            'edit' => Pages\EditPreguntaFrecuente::route('/{record}/edit'),
        ];
    }    
}
