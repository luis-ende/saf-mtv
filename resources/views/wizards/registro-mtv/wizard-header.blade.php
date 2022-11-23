<div class="text-slate-800 font-bold text-2xl p-6 bg-white border-b border-gray-200">
    @svg('bi-person-plus-fill', ['class' => 'h-7 w-7 inline-block mr-1'])
    {{ $wizard['title'] }}
</div>
<div class="p-6 bg-[#F7F3ED] border-b border-gray-200 text-base">
    Crea una cuenta de manera sencilla y ofrece tus productos para recibir notificaciones.
</div>
<div class="py-3 bg-[#691C32] m-3 mb-4 rounded pl-5 flex flex-row flex-wrap">
    @foreach($wizard['steps'] as $stepData)
    <div class="p-0 flex flex-row">
        <a class="{{ $stepData['active'] ? 'text-[#BC955C] fw-bold' : 'text-slate-200' }} text-base no-underline hover:text-[#BC955C] flex flex-row"
           href="{{ $stepData['url'] }}">
            @if($loop->index === 0)
                @svg('icomoon-profile', ['class' => 'h-5 w-5 inline-block mr-2'])
            @elseif ($loop->index === 1)
                @svg('bytesize-portfolio', ['class' => 'h-5 w-5 inline-block mr-2'])
            @elseif ($loop->index === 2)
                @svg('gmdi-storefront-o', ['class' => 'h-5 w-5 inline-block mr-2'])
            @endif

            <span>{{ $loop->index + 1 . '. ' . $stepData['title'] }}</span>
            @if($loop->index + 1 !== $loop->count)
                @svg('heroicon-s-arrow-right-circle', ['class' => 'h-5 w-5 inline-block mx-3 text-slate-200'])
            @endif
        </a>
    </div>
    @endforeach
</div>
