@props(['oportunidades' => []])

<div class="grid md:grid-cols-3 md:gap-5 sm:grid-cols-2 sm:gap-2">
    @foreach($oportunidades as $oportunidad)
        <x-oportunidades.oportunidad-card
            :oportunidad="$oportunidad" />
    @endforeach
</div>