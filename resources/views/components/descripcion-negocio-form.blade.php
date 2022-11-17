@props(['mode' => 'wizard', 'step' => null, 'wizard', 'grupos_prioritarios' => [], 'tipos_pyme' => [], 'sectores' => []])

@php($grupoPrioritarioId = isset($perfilNegocio) ? $perfilNegocio->id_grupo_prioritario : ( isset($step) ? $step['id_grupo_prioritario'] : old('id_grupo_prioritario')))
@php($tipoPymeId = isset($perfilNegocio) ? $perfilNegocio->id_tipo_pyme : ( isset($step) ? $step['id_tipo_pyme'] : old('id_tipo_pyme')))
@php($sectorId = isset($perfilNegocio) ? $perfilNegocio->id_sector : ( isset($step) ? $step['id_sector'] : old('id_sector')))
@php($diferenciadores = isset($perfilNegocio) ? $perfilNegocio->diferenciadores : ( isset($step) ? $step['diferenciadores'] : old('diferenciadores')))
@php($lema = isset($perfilNegocio) ? $perfilNegocio->lema_negocio : ( isset($step) ? $step['lema_negocio'] : old('lema_negocio')))
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
        <div class="flex flex-row">
            <div class="form-group">
                <label>Logotipo:</label>
                <x-input-image-viewer
                    :id="__('logotipo')"
                    :name="__('logotipo')"
                    :image_url="$logotipoUrl"
                />
                <input type="hidden" id="logotipo_path" name="logotipo_path" value="{{ $logotipoUrl ?? '' }}">
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="id_grupo_prioritario">¿Perteneces a algún sector prioritario?:</label>
                    <select class="form-control" id="id_grupo_prioritario" name="id_grupo_prioritario" x-model="grupoPrioritario" autofocus required>
                        <option value="0"> -- Ninguno --</option>
                        @foreach ((array) $grupos_prioritarios as $grupo)
                            <option
                                value={{ $grupo['id'] }}
                            >{{ $grupo['grupo'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4" x-show="grupoPrioritario == grupoPrioritarioMIPYMEId">
                    <label for="id_tipo_pyme">Tipo:</label>
                    <select class="form-control" id="id_tipo_pyme" name="id_tipo_pyme" x-model="tipoPyme">
                        <option selected value="0"> -- Seleccionar --</option>
                        @foreach ((array) $tipos_pyme as $tipo)
                            <option
                                value={{ $tipo['id'] }}
                            >{{ $tipo['tipo_pyme'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="id_sector">Sector:</label>
                    <select class="form-control" id="id_sector" name="id_sector" x-model="sector">
                        <option selected value="0"> -- Seleccionar --</option>
                        @foreach ((array) $sectores as $sector)
                            <option
                                value={{ $sector['id'] }}
                            >{{ $sector['sector'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="id_categoria_scian">Categoría:</label>
                    <select class="form-control" id="id_categoria_scian" name="id_categoria_scian">
                        <option selected value="0"> -- Seleccionar --</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="lema_negocio">Lema del negocio:</label>
                    <input type="text" class="form-control" id="lema_negocio" name="lema_negocio"
                        value="{{ $lema }}">
                    <x-input-error :messages="$errors->get('lema_negocio')" class="mt-2"/>
                </div>
                <div class="form-group col-md-4">
                    <x-diferenciadores-input :diferenciadores="$diferenciadores" />
                </div>
            </div>
        </div>
        <div class="row">
                <div class="form-group col-md-12">
                    <label for="descripcion_negocio">Descripción del negocio:</label>
                    <textarea class="form-control" id="descripcion_negocio" name="descripcion_negocio">{{ $descripcionNegocio }}</textarea>
                    <x-input-error :messages="$errors->get('descripcion_negocio')" class="mt-2"/>
                </div>
            </div>
        <div class="row">
            <div class="form-group col-md-4">
                <div class="flex flex-row space-x-2 my-2">
                    @svg('iconoir-internet', ['class' => 'h-5 w-5 inline-block'])
                    <label for="sitio_web">Sitio Web:</label>
                </div>
                <input type="text" class="form-control" id="sitio_web" name="sitio_web"
                       value="{{ $sitio_web }}">
            </div>
            <div class="form-group col-md-4">
                <div class="flex flex-row space-x-2 my-2">
                    @svg('iconpark-facebookone-o', ['class' => 'h-5 w-5 inline-block'])
                    <label for="cuenta_facebook">Facebook:</label>
                </div>
                <input type="text" class="form-control" id="cuenta_facebook" name="cuenta_facebook"
                       value="{{ $cuenta_facebook }}">
            </div>
            <div class="form-group col-md-4">
                <div class="flex flex-row space-x-2 my-2">
                    @svg('bi-twitter', ['class' => 'h-5 w-5 inline-block'])
                    <label for="cuenta_twitter">Twitter:</label>
                </div>
                <input type="text" class="form-control" id="cuenta_twitter" name="cuenta_twitter"
                       value="{{ $cuenta_twitter }}">
            </div>
            <div class="form-group col-md-4">
                <div class="flex flex-row space-x-2 my-2">
                    @svg('antdesign-linkedin-o', ['class' => 'h-5 w-5 inline-block'])
                    <label for="cuenta_linkedin">LinkedIn:</label>
                </div>
                <input type="text" class="form-control" id="cuenta_linkedin" name="cuenta_linkedin"
                       value="{{ $cuenta_linkedin }}">
            </div>
            <div class="form-group col-md-4">
                <div class="flex flex-row space-x-2 my-2">
                    @svg('ri-whatsapp-line', ['class' => 'h-5 w-5 inline-block'])
                    <label for="num_whatsapp">Whatsapp:</label>
                </div>
                <input type="text" class="form-control" id="num_whatsapp" name="num_whatsapp"
                       value="{{ $num_whatsapp }}">
            </div>
        </div>
            <div class="py-4 flex justify-content-end">
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
            </div>
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
