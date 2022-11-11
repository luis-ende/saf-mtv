@props(['mode' => 'wizard', 'step' => [], 'wizard', 'grupos_prioritarios' => []])

@php($grupoPrioritarioId = isset($perfilNegocio) ? $perfilNegocio->id_grupo_prioritario : ( isset($step) ? $step['id_grupo_prioritario'] : old('id_grupo_prioritario')))
@php($tipoPymeId = isset($perfilNegocio) ? $perfilNegocio->id_tipo_pyme : ( isset($step) ? $step['id_tipo_pyme'] : old('id_tipo_pyme')))
@php($sectorId = isset($perfilNegocio) ? $perfilNegocio->id_sector : ( isset($step) ? $step['id_sector'] : old('id_sector')))
@php($diferenciadores = isset($perfilNegocio) ? $perfilNegocio->diferenciadores : ( isset($step) ? $step['diferenciadores'] : old('diferenciadores')))

@php($gruposPrioritarios = [])
@isset ($step)
    @php($gruposPrioritarios = $step['grupos_prioritarios'])
@endisset

@php($tiposPyme = [])
@isset ($step)
    @php($tiposPyme = $step['tipos_pyme'])
@endisset

@php($sectores = [])
@isset ($step)
    @php($sectores = $step['sectores'])
@endisset

<div class="container" x-data="descripcionNegocioReglas()">
    @if ($mode === 'wizard')
        @php($wizardId = $wizard['id'])
    @endif

    <form method="POST" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'descripcion-negocio']) }}">
        @csrf
        <div class="row">
            <div class="form-group col-md-4">
                <label for="id_grupo_prioritario">¿Perteneces a algún sector prioritario?:</label>
                <select class="form-control" id="id_grupo_prioritario" name="id_grupo_prioritario" x-model="grupoPrioritario" autofocus required>
                    <option value="0"> -- Ninguno --</option>
                    @foreach ((array) $gruposPrioritarios as $grupo)
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
                    @foreach ((array) $tiposPyme as $tipo)
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
                       value="{{ $step['lema_negocio'] ?? old('lema_negocio') }}">
                <x-input-error :messages="$errors->get('lema_negocio')" class="mt-2"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label for="descripcion_negocio">Descripción del negocio:</label>
                <textarea class="form-control" id="descripcion_negocio" name="descripcion_negocio">
                    {{ $step['descripcion_negocio'] ?? old('descripcion_negocio') }}
                </textarea>
                <x-input-error :messages="$errors->get('descripcion_negocio')" class="mt-2"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <x-diferenciadores-input :diferenciadores="$diferenciadores" />
            </div>
            <div class="form-group col-md-4">
                <label for="sitio_web">Sitio Web:</label>
                <input type="text" class="form-control" id="sitio_web" name="sitio_web"
                       value="{{ $step['sitio_web'] ?? old('sitio_web') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="cuenta_facebook">Cuenta Facebook:</label>
                <input type="text" class="form-control" id="cuenta_facebook" name="cuenta_facebook"
                       value="{{ $step['cuenta_facebook'] ?? old('cuenta_facebook') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="cuenta_twitter">Cuenta Twitter:</label>
                <input type="text" class="form-control" id="cuenta_twitter" name="cuenta_twitter"
                       value="{{ $step['cuenta_twitter'] ?? old('cuenta_twitter') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="cuenta_linkedin">Cuenta LinkedIn:</label>
                <input type="text" class="form-control" id="cuenta_linkedin" name="cuenta_linkedin"
                       value="{{ $step['cuenta_linkedin'] ?? old('cuenta_linkedin') }}">
            </div>
            <div class="form-group col-md-4">
                <label for="num_whatsapp">Número Whatsapp:</label>
                <input type="text" class="form-control" id="num_whatsapp" name="num_whatsapp"
                       value="{{ $step['num_whatsapp'] ?? old('num_whatsapp') }}">
            </div>
        </div>
        @if ($mode === 'wizard')
            <div class="py-4">
                <a class="btn btn-primary" href="{{ route('wizard.registro-mtv.show', [$wizard['id'], 'perfil-negocio']) }}">Anterior</a>
                <button id="btn_siguiente" class="btn btn-primary">Siguiente</button>
            </div>
        @endif
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
