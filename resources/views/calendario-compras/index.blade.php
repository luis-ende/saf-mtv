<x-app-layout>      
    <div class="bg-white overflow-hidden min-h-screen">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">
                <label class="text-mtv-gray-2 md:text-xl">
                    Planeación anual
                </label>
                <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                    Compras programadas para el próximo año
                </h1>
            </div>
            <div class="self-center">
                <div class="flex flex-row space-x-4 mt-2">
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                </div>                    
            </div>                
            <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
                <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                    Identifica qué productos y servicios planea comprar la CDMX
                </span>
                <span class="md:w-2/5 block text-base xs:text-sm text-center">
                    En la sección <a href="{{ route('oportunidades-negocio.search') }}" class="underline font-bold mtv-link-gold">Oportunidades de negocio</a>
                    encontrarás los procedimientos programados.
                </span>
                <span class="md:w-2/5 block text-base xs:text-sm text-center">
                    Puedes agregarlos a tus favoritos para darles seguimiento.
                </span>
            </div>
        </div>
    </div>
</x-app-layout>      