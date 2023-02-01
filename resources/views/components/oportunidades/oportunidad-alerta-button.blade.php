@props(['oportunidad' => null, 'procedimiento_cerrado'])

@php($apiRoute = route("oportunidades-negocio-alertas.update", [$oportunidad->id]))
<button type="button" 
        :class="alertaActiva ? 'my-0 mtv-button-gold-light' : 'my-0 mtv-button-secondary'"
        x-data="oportunidadNegocioAlertas"
        x-init="alertaActiva = @js($oportunidad->alerta_estatus)"        
        @guest
        @click="showMessage()"
        @endguest
        @auth
        @click="toggleAlerta(@js($apiRoute), @js(csrf_token()))"
        @endauth
>    
    @svg('codicon-bell-dot', ['class' => 'w-5 h-5 inline-block mr-2'])
    <span x-text="alertaActiva ? 'Desactivar alerta' : 'Activar alerta'"></span>
</button>