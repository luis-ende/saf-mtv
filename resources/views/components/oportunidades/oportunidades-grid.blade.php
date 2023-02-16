@props(['oportunidades' => []])

<div class="grid md:grid-cols-3 md:gap-7 sm:grid-cols-2 sm:gap-2">
    @foreach($oportunidades as $oportunidad)
        <x-oportunidades.oportunidad-card
            :vista="request()->path()"
            :oportunidad="$oportunidad" />
    @endforeach
</div>