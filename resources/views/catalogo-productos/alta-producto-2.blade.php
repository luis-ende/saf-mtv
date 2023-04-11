<x-app-layout>
    @section('page_title', 'Alta de producto 2')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 2 de 4'])
            @php($productoId = $producto->id)
            @php($tipoProducto = $producto->tipo)
            @php($nombre = $producto->registro_fase >= 2 ? $producto->nombre : '' )
            @php($descripcion = $producto->registro_fase >= 2 ? $producto->descripcion : '' )
            @php($marca = $producto->registro_fase >= 2 ? $producto->marca : '' )
            @php($modelo = $producto->registro_fase >= 2 ? $producto->modelo : '' )
            @php($material = $producto->registro_fase >= 2 ? $producto->material : '' )
            @php($codigoBarras = $producto->registro_fase >= 2 ? $producto->codigo_barras : '' )
            @php($productoColor = $producto->registro_fase >= 2 ? $producto->color : '')
            <form method="POST" action="{{ route('alta-producto.store', [2, $productoId]) }}" class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Describe tu producto
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Los campos marcados con <span class="text-mtv-primary">*</span> son obligatorios.
                    </label>

                    <x-productos.producto-nombre-input
                        :value="$nombre" />

                    <x-productos.producto-descripcion-textarea
                        :value="$descripcion" />

                    <x-productos.producto-bien-inputs
                        :producto="$producto" />

                    <div class="flex flex-row my-4 space-x-10 justify-center">
                        <a href="{{ route('alta-producto-1.show', [$productoId]) }}"
                            class="mtv-button-secondary-white no-underline self-center">
                            @svg('fas-arrow-left', ['class' => 'h-5 w-5 inline-block mr-3'])
                            Atrás
                        </a>
                        <button type="submit"
                                class="mtv-button-secondary self-center my-4">
                                Siguiente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
