@props(['mode' => 'add', 'producto', 'wizard'])

@php($tipoProducto = isset($producto) ? $producto->tipo : ( isset($step) ? $step['tipo_producto'] : old('tipo_producto')))
@php($claveCABMS = isset($producto) ? $producto->clave_cabms : ( isset($step) ? $step['clave_cabms'] : old('clave_cabms')))
@php($nombreProducto = isset($producto) ? $producto->nombre : ( isset($step) ? $step['nombre_producto'] : old('nombre_producto')))
@php($descripcionProducto = isset($producto) ? $producto->descripcion : ( isset($step) ? $step['descripcion_producto'] : old('descripcion_producto')))
@php($precio = isset($producto) ? $producto->precio : ( isset($step) ? $step['precio'] : old('precio')))
@php($marca = isset($producto) ? $producto->marca : ( isset($step) ? $step['marca'] : old('marca')))
@php($modelo = isset($producto) ? $producto->modelo : ( isset($step) ? $step['modelo'] : old('modelo')))
@php($color = isset($producto) ? $producto->color : ( isset($step) ? $step['color'] : old('color')))
@php($material = isset($producto) ? $producto->material : ( isset($step) ? $step['material'] : old('material')))
@php($coverFotoUrl = isset($producto) ? $producto->getFirstMedia('fotos')?->getUrl('thumb-cropped') : null )

@if ($mode === 'add')
    @php($formAction = route('productos.store'))
@elseif ($mode === 'wizard')
    @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'catalogo-productos']))
@elseif ($mode === 'edit')
    @php($formAction = route('productos.update', $producto->id))
@endif

{{-- TODO: Remover componente image viewer --}}
@php($showImageViewer = false)

<div x-data="{ tipoProducto: '{{ $tipoProducto ?? 'B' }}' }">
    <form method="POST" action="{{ $formAction }}">
        @csrf
        <div class="{{ $showImageViewer ? 'flex flex-row flex-wrap' : '' }}">
            @if ($showImageViewer)
            <div class="md:basis-1/3 sm:basis-full xs:basis-full md:mb-0 sm:mb-5">
                <x-producto-image-viewer
                    :image_url="$coverFotoUrl"
                />
            </div>
            @endif
            <div class="{{ $showImageViewer ? 'basis-2/3' : '' }}">
                <div class="row">
                    <div class="form-group col-md-12 mb-3">
                        <label class="font-medium" class="mr-5">¿Qué producto ofreces?</label>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="tipo_producto_bien">Bien</label>
                            <input type="radio"
                                   class="form-check-input"
                                   id="tipo_producto_bien"
                                   x-model="tipoProducto"
                                   name="tipo_producto"
                                   value="B"
                                   checked
                            >
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="tipo_producto_servicio">Servicio</label>
                            <input type="radio"
                                   class="form-check-input"
                                   id="tipo_producto_servicio"
                                   x-model="tipoProducto"
                                   name="tipo_producto"
                                   value="S"
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="flex flex-row">
                            <div class="mtv-input-wrapper">
                                <input type="text"
                                    class="mtv-text-input"
                                    id="clave_cabms"
                                    name="clave_cabms"
                                    placeholder="Buscar clave CABMS..."
                                    value="{{ $claveCABMS }}"
                                    required readonly>
                                <label class="mtv-input-label" for="clave_cabms">Clave CABMS</label>
                            </div>
                            <a href="#"
                               class="text-base no-underline mtv-button-secondary-white self-end my-0"
                               data-bs-toggle="modal" data-bs-target="#cabmsModal">
                                @svg('fluentui-text-bullet-list-square-search-20', ['class' => 'h-10 w-7 inline-block'])
                            </a>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="nombre_producto" name="nombre_producto"
                               value="{{ $nombreProducto }}" required>
                            <label class="mtv-input-label" for="nombre_producto">Nombre del producto</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <textarea class="mtv-text-input" id="descripcion_producto"
                                    name="descripcion_producto" maxlength="140">{{ $descripcionProducto }}</textarea>
                            <label class="mtv-input-label" for="descripcion_producto">Descripcion</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="mtv-input-wrapper">
                            <input type="number"
                                min="0"
                                step=".01"
                                class="mtv-text-input"
                                id="precio" name="precio"
                                value="{{ $precio }}" required>
                            <label class="mtv-input-label" for="precio">Precio</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="marca" name="marca"
                                value="{{ $marca }}">
                            <label class="mtv-input-label" for="marca">Marca</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="modelo" name="modelo"
                               value="{{ $modelo }}">
                            <label class="mtv-input-label" for="modelo">Modelo</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="color" name="color"
                               value="{{ $color }}">
                               <label class="mtv-input-label" for="color">Color</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="material" name="material"
                                value="{{ $material }}">
                            <label class="mtv-input-label" for="material">Material</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-content-end">
            @if ($mode === 'add')
                <x-producto-importacion-button />

                <button class="mtv-button-secondary"
                        type="submit">
                    @svg('heroicon-m-plus-circle', ['class' => 'h-7 w-7 inline-block'])
                    Agregar producto
                </button>
            @else
                <button class="mtv-button-secondary" type="submit">
                    @svg('gmdi-save-as', ['class' => 'h-5 w-5 inline-block mr-1'])
                    Guardar
                </button>
            @endif
        </div>
    </form>

    <x-cabms-busqueda-modal />
</div>
