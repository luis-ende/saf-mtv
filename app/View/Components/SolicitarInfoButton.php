<?php

namespace App\View\Components;

use App\Models\Persona;
use App\Models\Producto;
use Illuminate\View\Component;

class SolicitarInfoButton extends Component
{    
    public array $usuarioURG = [];
    public int $proveedor_id;
    public string $proveedor_email;
    public string $proveedor_nombre;
    public ?string $producto_nombre = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Producto $producto = null, ?Persona $persona = null)
    {        
        if ($this->esUsuarioURG()) {
            $this->usuarioURG['id'] = request()->user()->id;
            $this->usuarioURG['nombre'] = request()->user()->urg->nombre;
            $this->usuarioURG['email'] = request()->user()->urg->email;
        }

        // El mensaje puede enviarse desde la página de detalle de un producto o desde la página de
        // perfil de negocio (info).
        if (isset($producto)) {
            $this->proveedor_id = $producto->id_persona;
            $this->proveedor_email = $producto->proveedor_email;
            $this->proveedor_nombre = $producto->nombre_negocio;
            $this->producto_nombre = $producto->nombre;
        } elseif ($persona) {
            $this->proveedor_id = $persona->id;
            $this->proveedor_email = $persona->email;
            $this->proveedor_nombre = $persona->perfil_negocio->nombre_negocio;
        }
    }    

    public function esUsuarioURG(): bool 
    {
        if (request()->user()) {
            return request()->user()->hasRole('urg');
        }

        return false;
    }

    /**
     * Obtiene el mensaje de la plantilla para el mensaje a enviar.
     */
    public function mensajePlantilla() 
    {
        $productosLabel = isset($this->producto_nombre) ? " el producto: {$this->producto_nombre}." : ' sus productos.';
        $usuarioURGNombre = $this->usuarioURG['nombre'];

        return "Estimado proveedor {$this->proveedor_nombre}, nos encontramos interesados en conocer más información sobre" . 
            $productosLabel . 
            "\n\n[Escriba aquí el mensaje]\n\nEsperamos contar con su pronta respuesta.\nAtentamente, {$usuarioURGNombre}";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.solicitar-info-button');
    }
}