<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioURGResource\Pages;
use App\Filament\Resources\UsuarioURGResource\RelationManagers;
use App\Models\User;
use App\Repositories\OportunidadNegocioRepository;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
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
        $opnRepo = new OportunidadNegocioRepository();
        $catUnidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras()
            ->pluck('nombre', 'id');

        // Todos los campos estáh deshabilitados para edición ya que por el momento
        // el formulario sirve solamente para activar o desactivar usuarios.

        return $form
            ->schema([
                TextInput::make('rfc')
                    ->label('RFC')
                    ->disabled()
                    ->required(),
                Toggle::make('activo')
                    ->label('Usuario activo')
                    ->onColor('success')
                    ->columnSpanFull(),
                Forms\Components\Section::make('Usuario URG')
                    ->relationship('urg')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre completo')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->disabled(),
                        Select::make('id_unidad_compradora')
                            ->label('Unidad compradora')
                            ->options($catUnidadesCompradoras)
                            ->disabled()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rfc')
                    ->label('RFC'),
                TextColumn::make('urg.nombre')
                    ->label('Nombre'),
                TextColumn::make('last_login')
                    ->label('Último acceso'),
                IconColumn::make('activo')->boolean(),
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
            //'create' => Pages\CreateUsuarioURG::route('/create'),
            'edit' => Pages\EditUsuarioURG::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Filtro para obtener solamente usuarios URG
        return parent::getEloquentQuery()->whereNotNull('id_urg');
    }
}
