{{-- Clase del componente: app/View/Components/EscritorioProveedor/CarruselSeccion.php --}}

<div x-data="carruselSeccion()"
     x-init="initCarrusel()"
     x-cloak
     class="h-full">
    <template x-for="slide in slides" :key="slide.id">
        <div x-show="activeSlide === slide.id"
             class="h-full flex flex-row bg-transparent">
            <a :href="slide.enlace" target="_blank"
               class="md:w-auto w-full h-[95%]">
                <img :src="slide.ruta_imagen" :alt="slide.nombre"
                     class="md:w-auto w-full h-full object-contain md:rounded-3xl rounded-xl">
            </a>
        </div>
    </template>
    <div class="h-1 w-1/3 flex items-center justify-center mx-auto">
        <template x-for="slide in slides" :key="slide.id">
            <button
                    class="flex-1 w-1 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-mtv-secondary hover:shadow-lg"
                    :class="{
                              'bg-mtv-gold-light': activeSlide === slide.id,
                              'bg-mtv-gray-light': activeSlide !== slide.id
                            }"
                    @click="activeSlide = slide.id"
            ></button>
        </template>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function carruselSeccion() {
            return {
                activeSlide: 1,
                slides: @js($slides),
                initCarrusel() {
                    if (this.slides.length > 0) {
                        this.activeSlide = this.slides[0].id;
                    }
                }
            }
        }
    </script>
@endpush