@props(['producto_id' => null, 'num_favoritos' => 0])

{{-- TIP: Buscar esta función reutilizable 'productoFavoritos()' en resources/js/app.js --}}
@php($esEditable = false)
@role('urg')
    @php($esEditable = true)
@endrole
<span x-data="productoFavoritos"
      x-init="esEditable = @json($esEditable); initFavoritos(@json($num_favoritos))">
    @if($esEditable)
    <button type="button"
       @click="toggleFavorito('{{ route('urg-productos-favoritos.update', [$producto_id]) }}', '{{ csrf_token() }}')"
       x-ref="controlFavoritos"
       :class="currentColor">
    @else   
    <span :class="currentColor">
    @endif
        @svg('gmdi-favorite-border-r', ['x-show' => 'numFavoritos === 0', 'class' => 'w-5 h-5 inline-block mr-1'])
        @svg('gmdi-favorite-r', ['x-show' => 'numFavoritos > 0', 'class' => 'w-5 h-5 inline-block mr-1'])        
        <span x-text="numFavoritos"></span>
    @if($esEditable)
    </button>
    @else
    </span>
    @endif
</span>