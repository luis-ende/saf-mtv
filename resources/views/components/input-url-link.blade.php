@props(['input_url' => '' ])

<div x-data="linkEditor_{{ $attributes['id'] }}()">
    <div class="flex flex-row" x-show="!showEditor">
        <a x-bind:href="inputLink" target="_blank" x-text="inputLink"></a>
        @svg('heroicon-s-pencil', ['@click' => 'showEditor = !showEditor', 'class' => 'h-5 w-5 inline-block ml-2'])
    </div>                
    <input type="url" x-show="showEditor" class="form-control" 
           {{ $attributes }} @blur="showEditor = inputLink === ''" @change="inputLink = $event.target.value; showEditor = inputLink === ''">
</div>

<script type="text/javascript">
    function linkEditor_{{ $attributes['id'] }}() {
        return {
            showEditor: {{ $input_url === '' ? 'true' : 'false' }},
            inputLink: '{{ $input_url }}',
        }        
    }
</script>