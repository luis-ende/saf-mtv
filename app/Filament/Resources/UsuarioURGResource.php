<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioURGResource\Pages;
use App\Filament\Resources\UsuarioURGResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsuarioURGResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'usuario URG';
    protected static ?string $pluralModelLabel = 'usuarios URG';

    protected static ?string $navigationGroup = 'Usuarios';
    protected static ?string $navigationLabel = 'Usuarios URG';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $slug = 'usuarios-urg';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rfc'),
                TextColumn::make('urg.nombre')
                    ->label('Nombre'),
                TextColumn::make('last_login'),
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
            'index' => Pages\ListUsuarioURGS::route('/'),
            'create' => Pages\CreateUsuarioURG::route('/create'),
            'edit' => Pages\EditUsuarioURG::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNotNull('id_urg');
    }
}
