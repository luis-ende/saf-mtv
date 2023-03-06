<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreguntaFrecuenteResource\Pages;
use App\Filament\Resources\PreguntaFrecuenteResource\RelationManagers;
use App\Models\PreguntasFrecuentes\PreguntaFrecuente;
use App\Repositories\PreguntasFrecuentesRepository;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PreguntaFrecuenteResource extends Resource
{
    protected static ?string $model = PreguntaFrecuente::class;

    protected static ?string $slug = 'catalogos/preguntas-frecuentes';
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Catálogos';

    public static function form(Form $form): Form
    {
        $preguntasFrecuentesRepo = new PreguntasFrecuentesRepository();
        $categoriasItems = $preguntasFrecuentesRepo->obtieneCategorias();
        $categorias = [];
        foreach ($categoriasItems as $item) {
            $categorias[$item['categoria_id']] = $item['nombre'];
        }

        return $form
            ->schema([
                Forms\Components\Select::make('categoria')
                    ->options($categorias)
                    ->default(1)
                    ->disablePlaceholderSelection()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('subcategoriaId', null))
                    ->required(),
                Forms\Components\Select::make('subcategoria')
                    ->options(function (callable $get) use($categoriasItems) {
                        $categoriaId = $get('categoria');
                        $categoria = array_filter($categoriasItems, function ($cat) use($categoriaId) {
                            return $cat['categoria_id'] == $categoriaId;
                        });
                        if (count($categoria) > 0) {
                            $subcategoriasItems = array_values($categoria)[0]['subcategorias'];
                            $subcategorias = [];
                            foreach ($subcategoriasItems as $item) {
                                $subcategorias[$item['subcategoria_id']] = $item['nombre'];
                            }

                            return $subcategorias;
                        }

                        return [];
                    })
                    ->disablePlaceholderSelection()
                    ->required(),
                TextInput::make('pregunta')
                    ->columnSpanFull()
                    ->required(),
                RichEditor::make('respuesta')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $preguntasFrecuentesRepo = new PreguntasFrecuentesRepository();
        $categoriasItems = $preguntasFrecuentesRepo->obtieneCategorias();

        return $table
            ->columns([
                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->getStateUsing(function ($record) use($categoriasItems) {
                        $categoriaId = $record->categoria;
                        $categoria = array_filter($categoriasItems, function ($cat) use($categoriaId) {
                            return $cat['categoria_id'] == $categoriaId;
                        });

                        if (count($categoria) > 0) {
                            return array_values($categoria)[0]['nombre'];
                        }

                        return $record->categoria;
                    })
                    ->sortable(),
                TextColumn::make('subcategoria')
                    ->label('Subcategoría')
                    ->getStateUsing(function ($record) use($categoriasItems) {
                        $categoriaId = $record->categoria;
                        $categoria = array_filter($categoriasItems, function ($cat) use($categoriaId) {
                            return $cat['categoria_id'] == $categoriaId;
                        });
                        if (count($categoria) > 0) {
                            $subcategoriaId = $record->subcategoria;
                            $subcategoriasItems = array_values($categoria)[0]['subcategorias'];
                            $subcategoria = array_filter($subcategoriasItems, function ($subcat) use($subcategoriaId) {
                                return $subcat['subcategoria_id'] == $subcategoriaId;
                            });

                            if (count($subcategoria) > 0) {
                                return array_values($subcategoria)[0]['nombre'];
                            }
                        }

                        return $record->subcategoria;
                    })
                    ->sortable(),
                TextColumn::make('pregunta')
                    ->label('Pregunta')
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
