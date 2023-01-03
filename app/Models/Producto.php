<?php

namespace App\Models;

use App\Models\ProductoCategoria;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Producto extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const TIPO_PRODUCTO_BIEN_ID = 'B';
    public const TIPO_PRODUCTO_SERVICIO_ID = 'S';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_cat_productos',
        'tipo',
        'id_cabms',
        'nombre',
        'descripcion',
        'marca',
        'modelo',
        'color',
        'material',
        'codigo_barras',
        'registro_fase',
        'foto_url_1',
        'foto_url_2',
        'foto_url_3',
    ];

    public function getAllMedia()
    {
        $mediaItems = [];
        $mediaFotos = $this->getMedia('fotos');
        foreach($mediaFotos as $foto) {
            $mediaItems[] = [
                'id' => $foto['id'],
                'name' => $foto['name'],
                'file_name' => $foto['file_name'],
                'mime_type' => $foto['mime_type'],
                'size' => $foto['size'],
                'original_url' => $foto['original_url'],
                'thumb_url' => $foto->getUrl('thumb-cropped'),
            ];
        }

        $mediaArchivos = $this->getMedia('documentos');
        foreach($mediaArchivos as $archivo) {
            $mediaItems[] = [
                'id' => $archivo['id'],
                'name' => $archivo['name'],
                'file_name' => $archivo['file_name'],
                'mime_type' => $archivo['mime_type'],
                'size' => $archivo['size'],
                'original_url' => $archivo['original_url'],
            ];
        }

        return $mediaItems;
    }

    public function catalogo()
    {
        return $this->belongsTo(CatalogoProductos::class, 'id_cat_productos');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb-cropped')
            ->crop('crop-center', 240, 160);
    }

    public function categorias()
    {
        return $this->hasMany(ProductoCategoria::class, 'id_producto');
    }
}
