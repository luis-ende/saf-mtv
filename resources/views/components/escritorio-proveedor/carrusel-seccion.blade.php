{{-- Clase del componente: app/View/Components/EscritorioProveedor/CarruselSeccion.php --}}

<div x-data="carruselSeccion()"
     x-init="initCarrusel()"
     x-cloak
     class="h-full">
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index"
             class="h-full flex flex-row bg-transparent">
            <a :href="slide.enlace" target="_blank"
               class="md:w-auto w-full h-[95%]">
                <img :src="slide.ruta_imagen" :alt="slide.nombre"
                     class="md:w-auto w-full h-full object-contain md:rounded-3xl rounded-xl">
            </a>
        </div>
    </template>
    <div class="h-1 w-1/3 flex items-center justify-center mx-auto">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                    class="flex-1 w-1 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-mtv-secondary hover:shadow-lg"
                    :class="{
                              'bg-mtv-gold-light': activeSlide === index,
                              'bg-mtv-gray-light': activeSlide !== index
                            }"
                    @click="activeSlide = index"
            ></button>
        </template>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function carruselSeccion() {
            return {
                activeSlide: 0,
                slides: @js($slides),
                initCarrusel() {
                    if (this.slides.length > 0) {
                        this.activeSlide = 0;

                        setInterval(() => {
                            if (this.activeSlide >= (this.slides.length - 1)) {
                                this.activeSlide = 0;
                            } else {
                                this.activeSlide += 1;
                            }
                        }, 5000);
                    }
                }
            }
        }
    </script>
@endpush