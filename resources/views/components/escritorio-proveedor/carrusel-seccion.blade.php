{{-- Clase del componente: app/View/Components/EscritorioProveedor/CarruselSeccion.php --}}

<div x-data="carruselSeccion()"
     x-cloak
     class="h-full">
    <template x-for="slide in slides" :key="slide.id">
        <div x-show="activeSlide === slide.id"
             class="h-full flex flex-row bg-mtv-secondary md:rounded-3xl rounded-xl md:py-0 py-2">
            <div class="basis-1/2">
                {{--Imagen--}}
            </div>
            <div class="basis-1/2 flex justify-center items-center">
                <div class="text-white 2xl:text-3xl xl:text-2xl lg:text-lg md:text-base text-base px-5 max-h-48">
                    <span class="block text-center" x-html="slide.text">
                        {{--Conoce <span class="block font-bold text-center">Contratos Marco</span>--}}
                    </span>
                </div>
            </div>
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
                slides: @js($slides)
            }
        }
    </script>
@endpush