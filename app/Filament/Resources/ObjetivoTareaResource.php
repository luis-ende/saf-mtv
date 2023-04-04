<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjetivoTareaResource\Pages;
use App\Models\Objetivos\ObjetivoTarea;
use App\Models\Objetivos\ObjetivoTareaCondicion;
use App\Models\Objetivos\ObjetivoTareaTipo;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ObjetivoTareaResource extends Resource
{
    protected static ?string $model = ObjetivoTarea::class;
    protected static ?string $modelLabel = 'Tareas';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Tareas de objetivos';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tipo_objetivo')
                        ->options(function (callable $get) {
                            $options = [];
                            foreach (ObjetivoTareaTipo::cases() as $tipo) {
                                $options[$tipo->value] = $tipo->name;
                            }

                            return $options;
                        }),
                TextInput::make('objetivo')
                    ->required(),
                TextInput::make('sugerencia')
                    ->label('Tarea o sugerencia')
                    ->required(),
                TextInput::make('url_accion')
                    ->label('Enlace')
                    ->helperText('Sólo subruta para páginas de MTV, por ejemplo: /catalogo-productos')
                    ->required(),
                Select::make('objetivo_condicion')
                    ->label('Tipo de condición')
                    ->helperText('Condición para mostrar la tarea en el banner del escritorio de proveedor.')
                    ->options(function (callable $get) {
                        $options = [];
                        foreach (ObjetivoTareaCondicion::cases() as $cond) {
                            $options[$cond->value] = $cond->name;
                        }

                        return $options;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipo_objetivo')
                    ->label('Tipo de objetivo')
                    ->getStateUsing(function (ObjetivoTarea $record): string {
                        $tipos = ObjetivoTareaTipo::cases();
                        foreach ($tipos as $tipo) {
                            if ($tipo->value === $record->tipo_objetivo) {
                                return $tipo->name;
                            }
                        }

                        return '';
                    })
                    ->sortable(),
                TextColumn::make('objetivo')
                    ->label('Objetivo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sugerencia')
                    ->label('Tarea')
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
            'index' => Pages\ListObjetivoTareas::route('/'),
            'create' => Pages\CreateObjetivoTarea::route('/create'),
            'edit' => Pages\EditObjetivoTarea::route('/{record}/edit'),
        ];
    }    
}
