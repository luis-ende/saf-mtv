@props(['accordion_key' => 1, 'categoria' => 1, 'subcategoria' => 1])

<div x-data="{
        categoria: @js($categoria),
        subcategoria: @js($subcategoria),
        selected: -1,
        preguntas: [],
        fetchPreguntas() {
            if (this.preguntas.length === 0) {
                fetch('/preguntas-frecuentes/list/' + this.categoria + '/' + this.subcategoria)
                    .then(res => res.json())
                    .then(json => this.preguntas = json);
            }
        }
    }" x-init="fetchPreguntas()">
    <ul>
        <template x-for="(item, index) in preguntas" :key="index">
            <li class="relative mt-3">
                <button type="button" class="w-full border-b pb-2 text-left text-base flex flex-row items-center"
                    :class="{ 'text-mtv-gold': selected !== index, 'text-mtv-secondary font-bold': selected === index }"
                    @click="selected !== index ? selected = index : selected = null">
                    <span>
                        @svg('bxs-minus-square', ['x-show' => 'selected === index', 'class' => 'w-5 h-5 inline-block'])
                        @svg('bxs-plus-square', ['x-show' => 'selected !== index', 'class' => 'w-5 h-5 inline-block'])
                    </span>
                    <span class="ml-3" x-text="item.pregunta"></span>
                </button>
                <div class="relative overflow-hidden max-h-0 text-mtv-text-gray text-base" style=""
                    x-ref="container_{{ $accordion_key }}"
                    x-bind:style="selected === index ? 'max-height: ' + $refs.container_{{ $accordion_key }}.scrollHeight + 5 + 'px' : ''">
                    <div class="py-6">
                        <p class="respuesta-enlaces" x-html="item.respuesta"></p>
                    </div>
                </div>
            </li>
        </template>
    </ul>
</div>