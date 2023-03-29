@props(['mensajes' => []])

<div class="flex flex-col">
    <div class="h-4/5">
        <div class="flex flex-row text-mtv-primary font-bold items-center">
            @svg('uni-comment-exclamation-o', ['class' => 'w-10 h-10 mr-5'])
            <span class="2xl:text-2xl xl:text-xl text-base">Centro de mensajes</span>
        </div>
        <div class="my-3">
            <span class="block text-mtv-text-gray font-bold">Total de mensajes: 10</span>
            <span class="block italic text-mtv-gray-2">Para conocer el detalle, revisa tu correo electrónico.</span>
        </div>
        <div class="h-96">
            @foreach($mensajes as $mensaje)
                <div class="mb-3">
                    <span class="block font-bold text-mtv-secondary">{{ $mensaje['nombre_urg'] }}</span>
                    <span class="block text-mtv-text-gray">{{ $mensaje['asunto'] }}</span>
                    <span class="block text-mtv-text-gray flex flex-row">
                                {{ $mensaje['fecha'] }}
                        @svg('entypo-dot-single', ['class' => 'w-4 h-4 self-center mx-1'])
                        {{ $mensaje['hora'] }}
                            </span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="h-1/4 flex flex-row items-center justify-center text-mtv-gold">
        1
        2
        3
        4
    </div>
</div>