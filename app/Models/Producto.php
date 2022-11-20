<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
        'clave_cabms',
        'nombre',
        'descripcion',
        'precio',
        'marca',
        'modelo',
        'color',
        'material',
    ];

    public function getAllMedia(): array
    {
        $fotos = array_map([$this, 'getMediaItem'], $this->getMedia('fotos')->toArray());
        $archivos = array_map([$this, 'getMediaItem'], $this->getMedia('archivos')->toArray());

        return array_merge($fotos, $archivos);
    }

    public function catalogo()
    {
        return $this->belongsTo(CatalogoProductos::class, 'id_cat_productos');
    }

    private function getMediaItem(array $item): array
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'file_name' => $item['file_name'],
            'mime_type' => $item['mime_type'],
            'size' => $item['size'],
            'original_url' => $item['original_url'],
        ];
    }
}
