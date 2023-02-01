@props(['oportunidad' => null, 'procedimiento_cerrado'])

<button type="button" 
        :class="alertaActiva ? 'my-0 mtv-button-gold-light' : 'my-0 mtv-button-secondary'"
        x-data="oportunidadNegocioAlertas"         
        @guest
        @click="showMessage()"
        @endguest
        @auth
        @click="toggleAlerta(@js(route("oportunidades-negocio-alertas.update", [$oportunidad->id])))"
        @endauth
        >
    @svg('codicon-bell-dot', ['class' => 'w-5 h-5 inline-block mr-2'])
    Activar alerta
</button>