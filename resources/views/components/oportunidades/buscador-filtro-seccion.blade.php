@props(['titulo' => '', 'key' => '1', 'last' => false])

<li class="relative border-t border-gray-200 {{ $last ? 'border-b' : '' }}" x-data="{ selected: null }">
    <button type="button" class="w-full py-3 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
        <div class="flex items-center justify-between">
            <span class="uppercase font-bold text-base">
                {{ $titulo }}
            </span>                    
            @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 1', 'class' => 'w-7 h-7'])
            @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 1', 'class' => 'w-7 h-7'])                    
        </div>
    </button>

    <div class="relative overflow-hidden transition-all max-h-0 duration-200" 
         style="" x-ref="container_{{ $key }}" x-bind:style="selected === 1 ? 'max-height: ' + $refs.container_{{ $key }}.scrollHeight + 'px' : ''">
        {{ $slot }}        
    </div>
</li>