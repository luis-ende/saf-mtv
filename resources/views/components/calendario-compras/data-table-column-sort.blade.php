@props(['data_column' => ''])

<button :title="sorted.field === '{{ $data_column }}' && sorted.rule === 'asc' ? 'Ordenar descendente' : 'Ordenar ascendente'">
    <span x-show="(sorted.field === '{{ $data_column }}' && sorted.rule === 'desc') || sorted.field !== '{{ $data_column }}'"
          @click.preventDefault="$data.sort('{{ $data_column }}', 'asc')">
        {{--Arrow down--}}
        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-5 h-5 inline-block'])
    </span>
    <span x-show="(sorted.field === '{{ $data_column }}' && sorted.rule === 'asc')"
          @click.preventDefault="$data.sort('{{ $data_column }}', 'desc')">
        {{--Arrow up (rotate-180)--}}
        @svg('fluentui-arrow-sort-down-lines-24-o', ['class' => 'w-5 h-5 inline-block rotate-180'])
    </span>
</button>