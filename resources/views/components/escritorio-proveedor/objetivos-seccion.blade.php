@props(['objetivos' => []])

<div class="flex flex-row flex-nowrap items-center text-mtv-secondary">
    <div class="w-10 text-center flex flex-col items-center mr-5">
        @svg('clarity-bullseye-line', ['class' => 'w-10 h-10'])
    </div>
    <span class="font-bold 2xl:text-2xl xl:text-xl text-base">Objetivos por lograr</span>
</div>
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