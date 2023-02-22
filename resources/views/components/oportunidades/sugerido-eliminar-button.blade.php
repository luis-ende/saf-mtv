@props(['oportunidad' => null])

<button type="button" 
        x-data="oportunidadNegocioSugeridos"         
        title="Borrar oportunidad sugerida"
        @click="eliminaSugerido(@js($oportunidad->id), '{{ csrf_token() }}')">
    @svg('heroicon-o-trash', ['class' => 'w-5 h-5 text-mtv-secondary inline-block stroke-2'])
</button>