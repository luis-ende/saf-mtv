<div x-data="letrasInicialesFiltro()"
     x-init="initLetrasInicialesFiltro()"
     class="flex flex-row space-x-3 md:space-x-8 justify-center"
     x-modelable="filtroActivo"
     x-model="filtroLetraInicial">
    @foreach($letrasIniciales as $inicial)
        <button type="button"
                class="text-2xl md:text-3xl font-bold mtv-link-gold no-underline p-1"
                :class="{ 'text-mtv-primary border-b-2 border-mtv-primary': filtroActivo === '{{ $inicial }}' }"
                @click="filtroActivo = '{{ $inicial }}'">
            {{ $inicial }}
        </button>
    @endforeach
</div>

@push('scripts')
<script type="text/javascript">
    function letrasInicialesFiltro() {
        return {
            filtroActivo: 'A',
            initLetrasInicialesFiltro() {
                this.$watch('terminoBusqueda', letra => {
                    if (this.filtroActivo !== '') {
                        this.filtroActivo = '';
                    }                    
                });
            }
        }
    }
</script>
@endpush