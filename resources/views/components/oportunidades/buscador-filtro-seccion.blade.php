@props(['titulo' => '', 'key' => '1', 'last' => false, 'selected' => null])

<li class="relative border-t border-gray-200 {{ $last ? 'border-b' : '' }}"
    :class="{'mb-28': filtrosModalOpen && @js($last)}"
    x-data="{ selected: null }"
    x-init="selected = @js((int)$selected); $watch('filtrosModalOpen', value => { if (value) { selected = 1 } })">
    <button type="button" class="w-full py-3 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
        <span class="flex items-center justify-between">
            <span class="uppercase font-bold text-base">
                {{ $titulo }}
            </span>                    
            @svg('ri-arrow-drop-up-line', ['x-show' => 'selected === 1', 'class' => 'w-7 h-7'])
            @svg('ri-arrow-drop-down-line', ['x-show' => 'selected !== 1', 'class' => 'w-7 h-7'])                    
        </span>
    </button>

    <div class="relative overflow-hidden transition-all max-h-0 duration-200" 
         style="" x-ref="container_{{ $key }}" x-bind:style="selected === 1 ? 'max-height: ' + $refs.container_{{ $key }}.scrollHeight + 'px' : ''">
        {{ $slot }}        
    </div>
</li>