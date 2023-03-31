@props(['objetivos' => []])

<div class="flex flex-col space-y-10">
    {{-- Título de la sección --}}
    <div class="flex flex-row flex-nowrap items-center text-mtv-secondary">
        <div class="w-10 text-center flex flex-col items-center mr-5">
            @svg('clarity-bullseye-line', ['class' => 'hidden md:flex w-10 h-10'])
        </div>
        <span class="hidden md:flex font-bold 2xl:text-2xl xl:text-xl text-base">Objetivos por lograr</span>

        {{-- Título visible sólo en versión responsiva --}}
        <div :class="{'flex flex-row justify-between items-center': $data.objetivosModalOpen, 'hidden': !$data.objetivosModalOpen}"
             class="fixed top-0 left-0 bg-white right-0 border-b-2 hidden h-12 pt-1 pl-6">
            <span class="font-bold text-base">Objetivos por lograr</span>
            <button @click="$data.objetivosModalOpen = !$data.objetivosModalOpen"
                    aria-label="Cerrar"
                    class="p-2 inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                <svg class="h-5 w-5" :class="{'hidden': !$data.objetivosModalOpen, 'inline-flex': $data.objetivosModalOpen }"
                     stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Lista de objetivos --}}
    @foreach($objetivos as $objetivo)
        <div class="flex flex-row flex-nowrap items-center text-mtv-text-gray-light">
            <div @class([
                    'w-10 flex flex-col items-center mr-5',
                    'text-mtv-secondary' => $objetivo['completo']
                    ])>
                @svg('feathericon-check-circle', ['class' => 'w-6 h-6'])
            </div>
            <span class="text-base text-mtv-text-gray">{{ $objetivo['objetivo'] }}</span>
        </div>
    @endforeach
</div>