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

@php($showImageViewer = $mode !== 'wizard' && $mode !== 'add')

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
                        <label class="font-medium" for="clave_cabms">Clave CABMS:</label>
                        <div class="flex flex-row">
                            <input type="text"
                                   class="form-control"
                                   style="background-color: #efefef"
                                   id="clave_cabms"
                                   name="clave_cabms"
                                   placeholder="Buscar clave CABMS..."
                                   value="{{ $claveCABMS }}"
                                   required readonly>
                            <a href="#"
                               class="text-base no-underline hover:text-[#BC955C]"
                               data-bs-toggle="modal" data-bs-target="#cabmsModal">
                                @svg('fluentui-text-bullet-list-square-search-20', ['class' => 'h-10 w-10 inline-block'])
                            </a>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label class="font-medium" for="nombre_producto">Nombre del producto:</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                               value="{{ $nombreProducto }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="font-medium" for="descripcion_producto">Descripcion:</label>
                        <textarea class="form-control" id="descripcion_producto"
                                  name="descripcion_producto" maxlength="140">{{ $descripcionProducto }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="font-medium" for="precio">Precio:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   min="0"
                                   step=".01"
                                   class="form-control"
                                   id="precio" name="precio"
                                   value="{{ $precio }}" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <label class="font-medium" for="marca">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca"
                               value="{{ $marca }}">
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <label class="font-medium" for="modelo">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" name="modelo"
                               value="{{ $modelo }}">
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <label class="font-medium" for="color">Color:</label>
                        <input type="text" class="form-control" id="color" name="color"
                               value="{{ $color }}">
                    </div>
                    <div class="form-group col-md-4" x-show="tipoProducto === 'B'">
                        <label class="font-medium" for="material">Material:</label>
                        <input type="text" class="form-control" id="material" name="material"
                               value="{{ $material }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4 flex justify-content-end">
            @if ($mode === 'add')
                <x-producto-importacion-button />

                <button class="btn btn-primary"
                        type="submit">
                    @svg('heroicon-m-plus-circle', ['class' => 'h-7 w-7 inline-block'])
                    Agregar producto
                </button>
            @elseif ($mode === 'wizard')
                <a class="btn btn-primary mr-3" href="{{ route('wizard.registro-mtv.show', [$wizard['id'], 'descripcion-negocio']) }}">
                    @svg('heroicon-s-arrow-left-circle', ['class' => 'h-5 w-5 inline-block'])
                    Anterior
                </a>
                <button id="btn_siguiente" class="btn btn-primary">
                    Finalizar registro
                    @svg('bi-check-circle-fill', ['class' => 'h-4 w-4 inline-block'])
                </button>
            @else
                <button class="btn btn-primary" type="submit">
                    @svg('gmdi-save-as', ['class' => 'h-5 w-5 inline-block mr-1'])
                    Guardar
                </button>
            @endif
        </div>
    </form>

    <x-cabms-busqueda-modal />
</div>
