@props(['producto_id' => null, 'num_favoritos' => 0])

<span x-data="productoFavoritos_{{ $producto_id }}()" 
    x-init="numFavoritos = @json($num_favoritos)">
    @role(['urg'])
    <button type="button"
       @click="toggleFavorito()"
       x-bind:class="numFavoritos > 0 ? colorConFavoritos : colorSinFavoritos">
    @else   
    <span x-bind:class="numFavoritos > 0 ? colorConFavoritos : colorSinFavoritos">
    @endrole        
        @svg('gmdi-favorite-border-r', ['x-show' => 'numFavoritos === 0', 'class' => 'w-5 h-5 inline-block mr-1'])
        @svg('gmdi-favorite-r', ['x-show' => 'numFavoritos > 0', 'class' => 'w-5 h-5 inline-block mr-1'])        
        <span x-text="numFavoritos"></span>
    @role('urg')
    </button>
    @else
    </span>
    @endrole
    
    <script type="text/javascript">
        function productoFavoritos_{{ $producto_id }}() {
            return {
                colorSinFavoritos: 'text-mtv-gold hover:fill-mtv-primary',
                colorConFavoritos: 'text-mtv-primary hover:fill-mtv-gold',
                numFavoritos: 0, 
                @role('urg')
                toggleFavorito() {                        
                    fetch("{{ route('urg-productos-favoritos.update', [$producto_id]) }}", {
                        method: "POST",                            
                        credentials: 'same-origin',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },                            
                    }).then(response => response.json())
                        .then(json => {
                        console.log(json);
                        this.numFavoritos = json.num_favoritos;
                    })
                },
                @endrole
            }
        }
    </script>    
</span>