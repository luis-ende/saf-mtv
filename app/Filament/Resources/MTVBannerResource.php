<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MTVBannerResource\Pages;
use App\Filament\Resources\MTVBannerResource\RelationManagers;
use App\Models\Banners\MTVBanner;
use App\Models\Banners\MTVBannerTipo;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MTVBannerResource extends Resource
{
    protected static ?string $model = MTVBanner::class;
    protected static ?string $modelLabel = 'Banners';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Banners';

    protected static ?string $navigationIcon = 'heroicon-o-template';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tipo')
                    ->required()
                    ->disablePlaceholderSelection()
                    ->default(MTVBannerTipo::EscritorioProveedor->value)
                    ->options(function (callable $get) {
                        $options = [];
                        foreach (MTVBannerTipo::cases() as $tipo) {
                            $options[$tipo->value] = $tipo->name;
                        }

                        return $options;
                    }),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('enlace')
                    ->required()
                    ->helperText('Enlace a alguna página al hacer clic sobre el banner.'),
                FileUpload::make('ruta_imagen')
                    ->required()
                    ->image()
                    ->preserveFilenames()
                    ->disk('public')
                    ->directory('images/banners'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipo')
                    ->label('Tipo de banner')
                    ->getStateUsing(function (MTVBanner $record): string {
                        $tipos = MTVBannerTipo::cases();
                        foreach ($tipos as $tipo) {
                            if ($tipo->value === $record->tipo) {
                                return $tipo->name;
                            }
                        }

                        return '';
                    })
                    ->sortable(),
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
            'index' => Pages\ListMTVBanners::route('/'),
            'create' => Pages\CreateMTVBanner::route('/create'),
            'edit' => Pages\EditMTVBanner::route('/{record}/edit'),
        ];
    }    
}
