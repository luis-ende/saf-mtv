<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnidadCompradoraResource\Pages;
use App\Filament\Resources\UnidadCompradoraResource\RelationManagers;
use App\Models\UnidadCompradora;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnidadCompradoraResource extends Resource
{
    protected static ?string $model = UnidadCompradora::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';
    protected static ?string $modelLabel = 'Unidad compradora o Unidad Responsable de Gasto';
    protected static ?string $pluralModelLabel = 'Unidades compradoras o Unidades Responsables de Gasto';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Unidades compradoras';

    protected static ?string $slug = 'unidades-compradoras';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->label('Nombre'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
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
            'index' => Pages\ListUnidadCompradoras::route('/'),
            'create' => Pages\CreateUnidadCompradora::route('/create'),
            'edit' => Pages\EditUnidadCompradora::route('/{record}/edit'),
        ];
    }    
}
