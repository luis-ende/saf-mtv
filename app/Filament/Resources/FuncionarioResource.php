<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuncionarioResource\Pages;
use App\Filament\Resources\FuncionarioResource\RelationManagers;
use App\Models\Directorio\Funcionario;
use App\Repositories\OportunidadNegocioRepository;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FuncionarioResource extends Resource
{
    protected static ?string $model = Funcionario::class;

    protected static ?string $navigationIcon = 'heroicon-s-office-building';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Directorio CDMX';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $opnRepo = new OportunidadNegocioRepository();
        $catUnidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras()
                                          ->pluck('nombre', 'id');

        return $form
            ->schema([
                Select::make('id_unidad_compradora')
                    ->label('Unidad compradora')
                    ->options($catUnidadesCompradoras)
                    ->default(1)
                    ->disablePlaceholderSelection()
                    ->required(),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('puesto')
                    ->required(),
                TextInput::make('telefono_oficina')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                RichEditor::make('funciones')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $opnRepo = new OportunidadNegocioRepository();
        $catUnidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras();

        return $table
            ->columns([
                TextColumn::make('id_unidad_compradora')
                    ->label('Unidad compradora')
                    ->limit(50)
                    ->getStateUsing(function ($record) use($catUnidadesCompradoras) {
                        $uc = $catUnidadesCompradoras->firstWhere('id', $record->id_unidad_compradora);
                        if ($uc) {
                            return $uc->nombre;
                        }

                        return $record->id_unidad_compradora;
                    })
                    ->sortable(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('puesto')
                    ->label('Puesto')
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
            'index' => Pages\ListFuncionarios::route('/'),
            'create' => Pages\CreateFuncionario::route('/create'),
            'edit' => Pages\EditFuncionario::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('id_unidad_compradora');
    }
}
