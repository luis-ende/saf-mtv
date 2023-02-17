@props(['oportunidades' => []])

@foreach($oportunidades as $oportunidad)
    <x-oportunidades.oportunidad-card
            :oportunidad="$oportunidad"            
    />
@endforeach