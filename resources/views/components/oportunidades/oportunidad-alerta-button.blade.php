@props(['oportunidad' => null, 'procedimiento_cerrado' => false])

@if($procedimiento_cerrado)
    <div class="my-0 text-white font-bold bg-mtv-gray-light border border-slate-200 rounded-lg px-3 py-2">
        @svg('gmdi-bookmark-add-o', ['class' => 'w-5 h-5 inline-block mr-2'])
        Guardar oportunidad
    </div>
@else
    @php($apiRoute = route("oportunidades-negocio-alertas.update", [$oportunidad->id]))
    <button type="button" 
            :class="alertaActiva ? 'my-0 mtv-button-gold-light' : 'my-0 mtv-button-secondary'"
            x-data="oportunidadNegocioAlertas"
            x-init="alertaActiva = @js($oportunidad->alerta_estatus)"        
            @guest        
                @php($queryString = count(request()->query()) > 0 ? '&' . http_build_query(request()->query()) : '')
                @php($loginRuta = route('login') . '?url=oportunidades_negocio' . $queryString)
                @click="showMessage(@js($loginRuta), @js(route('registro-inicio')))"
            @endguest
            @auth
                @click="toggleAlerta(@js($apiRoute), @js(csrf_token()))"
            @endauth
    >    
        @svg('gmdi-bookmark-add-o', ['class' => 'w-5 h-5 inline-block mr-2'])
        <span x-text="alertaActiva ? 'Borrar oportunidad' : 'Guardar oportunidad'"></span>
    </button>
@endif