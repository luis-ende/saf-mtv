@props(['mode' => 'wizard', 'step' => null, 'wizard', 'grupos_prioritarios' => [], 'tipos_pyme' => [], 'sectores' => []])

@php($grupoPrioritarioId = isset($perfilNegocio) ? $perfilNegocio->id_grupo_prioritario : ( isset($step) ? $step['id_grupo_prioritario'] : old('id_grupo_prioritario')))
@php($tipoPymeId = isset($perfilNegocio) ? $perfilNegocio->id_tipo_pyme : ( isset($step) ? $step['id_tipo_pyme'] : old('id_tipo_pyme')))
@php($sectorId = isset($perfilNegocio) ? $perfilNegocio->id_sector : ( isset($step) ? $step['id_sector'] : old('id_sector')))
@php($diferenciadores = isset($perfilNegocio) ? $perfilNegocio->diferenciadores : ( isset($step) ? $step['diferenciadores'] : old('diferenciadores')))
@php($lema = isset($perfilNegocio) ? $perfilNegocio->lema_negocio : ( isset($step) ? $step['lema_negocio'] : old('lema_negocio')))
@php($nombreNegocio = isset($perfilNegocio) ? $perfilNegocio->nombre_negocio : ( isset($step) ? $step['nombre_negocio'] : old('nombre_negocio')))
@php($descripcionNegocio = isset($perfilNegocio) ? $perfilNegocio->descripcion_negocio : ( isset($step) ? $step['descripcion_negocio'] : old('descripcion_negocio')))
@php($sitio_web = isset($perfilNegocio) ? $perfilNegocio->sitio_web : ( isset($step) ? $step['sitio_web'] : old('sitio_web')))
@php($cuenta_facebook = isset($perfilNegocio) ? $perfilNegocio->cuenta_facebook : ( isset($step) ? $step['cuenta_facebook'] : old('cuenta_facebook')))
@php($cuenta_twitter = isset($perfilNegocio) ? $perfilNegocio->cuenta_twitter : ( isset($step) ? $step['cuenta_twitter'] : old('cuenta_twitter')))
@php($cuenta_linkedin = isset($perfilNegocio) ? $perfilNegocio->cuenta_linkedin : ( isset($step) ? $step['cuenta_linkedin'] : old('cuenta_linkedin')))
@php($num_whatsapp = isset($perfilNegocio) ? $perfilNegocio->num_whatsapp : ( isset($step) ? $step['num_whatsapp'] : old('num_whatsapp')))
@php($logotipoUrl = isset($perfilNegocio) ? $perfilNegocio->getFirstMediaUrl('logotipos') : ( isset($step) ? $step['logotipo_path'] : null))

@isset ($step)
    @php($grupos_prioritarios = $step['grupos_prioritarios'])
@endisset

@isset ($step)
    @php($tipos_pyme = $step['tipos_pyme'])
@endisset

@isset ($step)
    @php($sectores = $step['sectores'])
@endisset

@if ($mode === 'wizard')
    @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'descripcion-negocio']))
@elseif ($mode === 'edit')
    @php($formAction = route('descripcion-negocio.update'))
@endif

<div class="container" x-data="descripcionNegocioReglas()">
    <form method="POST" enctype="multipart/form-data" action="{{ $formAction }}">
        @csrf
        <div class="flex flex-row flex-wrap">
            <div class="md:basis-1/4 xs:basis-full pr-8 mt-3">
                <x-input-image-viewer
                    :id="__('logotipo')"
                    :name="__('logotipo')"
                    :image_url="$logotipoUrl"
                />
                <input type="hidden" id="logotipo_path" name="logotipo_path" value="{{ $logotipoUrl ?? '' }}">
                <label class="to-mtv-text-gray my-2">Sitio web y redes sociales</label>
                <div class="flex flex-row flex-nowrap justify-between mb-3 text-mtv-gold">
                    @svg('iconoir-internet', ['class' => 'h-5 w-5'])
                    @svg('iconpark-facebookone-o', ['class' => 'h-5 w-5'])
                    @svg('bi-twitter', ['class' => 'h-5 w-5'])
                    @svg('antdesign-linkedin-o', ['class' => 'h-5 w-5'])
                    @svg('ri-whatsapp-line', ['class' => 'h-5 w-5'])
                </div>
            </div>
            <div class="md:basis-3/4 xs:basis-full row">
                <div class="form-group col-md-4">
                    <div class="mtv-input-wrapper">
                        <select class="mtv-text-input" id="id_grupo_prioritario" name="id_grupo_prioritario" x-model="grupoPrioritario" autofocus required>
                            <option value="0"> -- Ninguno --</option>
                            @foreach ((array) $grupos_prioritarios as $grupo)
                                <option
                                    value={{ $grupo['id'] }}
                                >{{ $grupo['grupo'] }}</option>
                            @endforeach
                        </select>
                        <label class="mtv-input-label" for="id_grupo_prioritario">¿Perteneces a algún sector prioritario?</label>
                    </div>
                </div>
                <div class="form-group col-md-4" x-show="grupoPrioritario == grupoPrioritarioMIPYMEId">
                    <div class="mtv-input-wrapper">
                        <select class="mtv-text-input" id="id_tipo_pyme" name="id_tipo_pyme" x-model="tipoPyme">
                            <option selected value="0"> -- Seleccionar --</option>
                            @foreach ((array) $tipos_pyme as $tipo)
                                <option
                                    value={{ $tipo['id'] }}
                                >{{ $tipo['tipo_pyme'] }}</option>
                            @endforeach
                        </select>
                        <label class="mtv-input-label" for="id_tipo_pyme">Tipo</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="mtv-input-wrapper">
                        <select class="mtv-text-input" id="id_sector" name="id_sector" x-model="sector">
                            <option selected value="0"> -- Seleccionar --</option>
                            @foreach ((array) $sectores as $sector)
                                <option
                                    value={{ $sector['id'] }}
                                >{{ $sector['sector'] }}</option>
                            @endforeach
                        </select>
                        <label class="mtv-input-label" for="id_sector">Sector</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="mtv-input-wrapper">
                        <select class="mtv-text-input" id="id_categoria_scian" name="id_categoria_scian">
                            <option selected value="0"> -- Seleccionar --</option>
                        </select>
                        <label class="mtv-input-label" for="id_categoria_scian">Giro</label>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <div class="mtv-input-wrapper">
                        <input type="text" class="mtv-text-input" id="nombre_negocio" name="nombre_negocio"
                            value="{{ $nombreNegocio }}" required>
                        <label class="mtv-input-label" for="nombre_negocio">Nombre comercial de tu negocio</label>
                    </div>
                    <x-input-error :messages="$errors->get('nombre_negocio')" class="mt-2"/>
                </div>
                <div class="form-group col-md-12">
                    <div class="mtv-input-wrapper">
                        <input type="text" class="mtv-text-input" id="lema_negocio" name="lema_negocio"
                            value="{{ $lema }}" required>
                        <label class="mtv-input-label" for="lema_negocio">Lema del negocio</label>
                    </div>
                    <x-input-error :messages="$errors->get('lema_negocio')" class="mt-2"/>
                </div>
                <div class="form-group col-md-12">
                    <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="descripcion_negocio" name="descripcion_negocio" required>{{ $descripcionNegocio }}</textarea>
                        <label class="mtv-input-label" for="descripcion_negocio">Descripción del negocio</label>
                    </div>
                    <x-input-error :messages="$errors->get('descripcion_negocio')" class="mt-2"/>
                </div>
                <div class="form-group col-md-12">
                    <x-diferenciadores-input :diferenciadores="$diferenciadores" />
                </div>
                <div class="form-group col-md-12 w-full" x-data="{ cartaPresentacion: null }">
                    <label class="text-mtv-text-gray my-3">
                        ¿Quieres subir tu carta de presentación? Agrégala en formato PDF de hasta 3MB.
                    </label>
                    <div class="flex flex-row justify-start text-mtv-gold font-bold">
                        <div class="flex flex-row cursor-pointer"
                             @click="$refs.inputCartaPresentacion.click()"
                        >
                            @svg('uiw-paper-clip', ['class' => 'h-9 w-9 mr-3'])
                            <span class="w-full self-center">Adjuntar documento</span>
                            <input id="carta_presentacion" name="carta_presentacion"
                                   class="invisible"
                                   type="file" accept="file/pdf"
                                   x-ref="inputCartaPresentacion"
                                   @change="cartaPresentacion = $event.target.value.replace(/^.*[\\\/]/, '')"
                            >
                        </div>
                    </div>
                    <div class="text-mtv-text-gray" x-show="cartaPresentacion !== null">
                        @svg('uiw-paper-clip', ['class' => 'h-3 w-3 inline-block mr-5'])
                        <label class="font-bold" x-text="cartaPresentacion"></label>
                        @svg('sui-cross', [
                            'class' => 'h-3 w-3 inline-block ml-3 cursor-pointer',
                            '@click' => "document.getElementById('carta_presentacion').value = null; cartaPresentacion = null"
                        ])
                    </div>
                </div>
            </div>
        </div>
            {{--<div class="py-4 flex justify-content-end">
                @if ($mode === 'wizard')
                    <a class="btn btn-primary mr-3" href="{{ route('wizard.registro-mtv.show', [$wizard['id'], 'perfil-negocio']) }}">
                        @svg('heroicon-s-arrow-left-circle', ['class' => 'h-5 w-5 inline-block'])
                        Anterior
                    </a>
                    <button id="btn_siguiente" class="btn btn-primary">
                        Siguiente
                        @svg('heroicon-s-arrow-right-circle', ['class' => 'h-5 w-5 inline-block'])
                    </button>
                @elseif ($mode === 'edit')
                    <button class="btn btn-primary" type="submit">
                        @svg('gmdi-save-as', ['class' => 'h-5 w-5 inline-block mr-1'])
                        Guardar
                    </button>
                @endif
            </div>--}}
    </form>
</div>

<script type="text/javascript">
    function descripcionNegocioReglas() {
        return {
            grupoPrioritarioMIPYMEId: 1,
            grupoPrioritario: {{ $grupoPrioritarioId ?? 0 }},
            tipoPyme: {{ $tipoPymeId ?? 0 }},
            sector: {{ $sectorId ?? 0 }},
            diferenciadores: '',
        }
    }
</script>
