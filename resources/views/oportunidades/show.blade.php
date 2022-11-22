<x-guest-layout>
<div class="min-h-screen">
    <div class="flex flex-row flex-nowrap space-x-4 my-3">
        <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/4 p-3 text-lg-center font-bold">30 Dependencias</div>
        <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/4 p-3 text-lg-center font-bold">100 Procedimientos próximos</div>
        <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/4 p-3 text-lg-center font-bold">10 Invitaciones restringidas</div>
        <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/4 p-3 text-lg-center font-bold">10 Adjudicaciones directas</div>
    </div>

    <div class="accordion" id="oportunidades-accordion">
        @foreach($categorias as $categoria => $oportunidades)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-oportunidad-{{ $loop->index }}">
                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-oportunidad-{{ $loop->index }}" aria-expanded="true" aria-controls="body-oportunidad-{{ $loop->index }}">
                    @svg('govicon-building', ['class' => 'h-5 w-5 inline-block mr-3'])
                    {{ $categoria }} ({{ count($oportunidades) }} Procedimientos)
                </button>
            </h2>
            <div id="body-oportunidad-{{ $loop->index }}" class="accordion-collapse collapse show" aria-labelledby="heading-oportunidad-{{ $loop->index }}" data-bs-parent="#oportunidades-accordion">
                <div class="accordion-body flex flex-row flex-wrap">
                    @foreach($oportunidades as $oportunidad)
                    <div class="rounded border border-3 border-gray-200 p-3 mb-2 basis-1/2">
                        <p class="bg-gray-300 rounded font-bold m-0 text-[#691C32] p-2 mb-2">{{ $oportunidad['nombre_procedimiento'] }}</p>
                        <p class="m-0"><span class="font-bold">Fecha de publicación:</span> {{ $oportunidad['fecha_publicacion'] }}</p>
                        <p class="m-0"><span class="font-bold">Presentación de propuestas:</span> {{ $oportunidad['fecha_presentacion_propuestas'] }}</p>
                        <p class="m-0"><span class="font-bold">Tipo de contratación:</span> {{ $oportunidad['tipo_contratacion'] }}</p>
                        <p class="m-0"><span class="font-bold">Modo de contratación:</span> {{ $oportunidad['metodo_contratacion'] }}</p>
                        <p class="m-0"><span class="text-sm">*Para poder cotizar necesitas registrarte o iniciar sesión si ya cuentas con un registro en el Padrón de Proveedores</p>
                    </div>
                    <div class="rounded border border-3 border-gray-200 p-3 mb-2 basis-1/2">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


</x-guest-layout>
