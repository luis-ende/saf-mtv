<label class="text-[#BC955C] mt-3 text-2xl font-bold mx-3">{{ $wizard['title'] }}</label>
<div class="py-3 bg-[#691C32] m-3 mb-4 rounded pl-5 flex flex-row flex-wrap">
    @foreach($wizard['steps'] as $stepData)
        <div class="p-0 flex flex-row">
            <a class="{{ $stepData['active'] ? 'text-[#BC955C] fw-bold' : 'text-slate-200' }} text-base no-underline hover:text-[#BC955C] flex flex-row"
               href="{{ $stepData['url'] }}">
                @if($loop->index === 0)
                    @svg('icomoon-profile', ['class' => 'h-5 w-5 inline-block'])
                @elseif ($loop->index === 1)
                    @svg('bytesize-portfolio', ['class' => 'h-5 w-5 inline-block'])
                @elseif ($loop->index === 2)
                    @svg('gmdi-storefront-o', ['class' => 'h-5 w-5 inline-block'])
                @endif
                {!! "&nbsp;" !!}
                <span>{{ $stepData['title'] }}</span>
                @if($loop->index + 1 !== $loop->count)
                    {!! "&nbsp;" !!}
                    {!! "&nbsp;" !!}
                    {!! "&nbsp;" !!}
                    @svg('heroicon-s-arrow-right-circle', ['class' => 'h-5 w-5 inline-block'])
                    {!! "&nbsp;" !!}
                    {!! "&nbsp;" !!}
                    {!! "&nbsp;" !!}
                @endif
            </a>
        </div>
    @endforeach
</div>
