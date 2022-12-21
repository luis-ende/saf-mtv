@props(['categorias' => []])

<div class="accordion" id="oportunidades-accordion">
    @foreach($categorias as $categoria => $oportunidades)
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-oportunidad-{{ $loop->index }}">
            <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#body-oportunidad-{{ $loop->index }}" aria-expanded="true" aria-controls="body-oportunidad-{{ $loop->index }}">
                {{ $categoria }} ({{ count($oportunidades) }} Procedimiento{{ count($oportunidades) > 1 ? 's' : '' }})
            </button>
        </h2>
        <div id="body-oportunidad-{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading-oportunidad-{{ $loop->index }}" data-bs-parent="#oportunidades-accordion">
            <div class="accordion-body flex flex-row flex-wrap">
                <a href="{{ route('programacion-anual', ['entidad' => $categoria]) }}" class="font-bold no-underline mb-2 text-[#BC955C]">
                    @svg('icomoon-calendar', ['class' => 'h-5 w-5 inline-block mr-1'])
                    Ir a Programación Anual
                </a>
                @foreach($oportunidades as $oportunidad)
                <div class="w-full rounded border border-dashed border-gray-200 p-2 mb-3">
                    <div class="block bg-gray-300 rounded font-bold m-0 text-mtv-primary p-2 mb-2">
                        {{ $oportunidad['nombre_procedimiento'] }}
                    </div>
                    <div class="w-full p-2 flex flex-row">
                        <div class="basis-1/2">
                            <p class="m-0"><span class="font-bold">Fecha de publicación:</span> {{ $oportunidad['fecha_publicacion'] }}</p>
                            <p class="m-0"><span class="font-bold">Presentación de propuestas:</span> {{ $oportunidad['fecha_presentacion_propuestas'] }}</p>
                            <p class="m-0"><span class="font-bold">Tipo de contratación:</span> {{ $oportunidad['tipo_contratacion'] }}</p>
                            <p class="m-0"><span class="font-bold">Modo de contratación:</span> {{ $oportunidad['metodo_contratacion'] }}</p>
                            <p class="m-0"><span class="text-sm text-slate-600">*Para poder cotizar necesitas registrarte o iniciar sesión si ya cuentas con un registro en el Padrón de Proveedores</p>
                        </div>
                        <div class="basis-1/2 flex flex-row items-center space-x-4">
                            <div><p class="basis-1/5 border rounded bg-mtv-primary text-slate-200 text-sm text-center p-3">Programado próximamente</p></div>
                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Prebases</p></div>
                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Oportunidades de negocio</p></div>
                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Pre-cotizar</p></div>
                            <div class="basis-1/5 text-center">
                                @svg('lucide-bell-plus', ['class' => 'h-7 w-7 inline-block mr-3 cursor-pointer'])
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
