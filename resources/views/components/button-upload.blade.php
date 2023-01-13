@props([
    'title' => '', 
    'name' => 'button_upload', 
    'id' => 'button_upload',     
    'file_info' => null,
    'eliminar_input_name' => 'eliminar_input',
    'eliminar_input_id' => 'eliminar_input',
])

<div class="w-full"
    x-data="buttonUpload_{{ $id }}">
    <label class="text-mtv-text-gray font-bold my-3">
        {{ $title }}
    </label>
    <div clasS="flex flex-row flex-wrap">
        <div class="flex flex-row justify-start text-mtv-gold font-bold border rounded px-3 w-32">
            <div class="flex flex-row cursor-pointer"
                    @click="$refs.input_{{ $id }}.click()">
                @svg('uiw-paper-clip', ['class' => 'h-9 w-9 mr-3'])
                <span class="w-full self-center">Adjuntar</span>
                <input id="{{ $id }}" 
                       name="{{ $name }}"
                       class="invisible"
                       type="file" accept="application/pdf"
                       x-ref="input_{{ $id }}"
                       @change="fileName_{{ $id }} = $event.target.value.replace(/^.*[\\\/]/, '')">
                <input id="{{ $eliminar_input_name }}"
                        name="{{ $eliminar_input_id }}"
                        type="hidden"
                        x-bind:value="fileName_{{ $id }} === '' ? 1 : 0">
            </div>
        </div>
        <div class="text-mtv-text-gray ml-5 self-center" x-show="fileName_{{ $id }} !== ''">
            <a x-show="fileURL_{{ $id }} !== ''" x-bind:href="fileURL_{{ $id }}"
                class="mtv-link-download-gold"
                x-text="fileName_{{ $id }}"
                target="_blank"></a>
            <label class="mtv-link-download-gold"
                    x-show="fileURL_{{ $id }} === ''"
                    x-text="fileName_{{ $id }}"></label>
            @svg('sui-cross', [
                'class' => 'h-3 w-3 inline-block ml-3 mtv-link-download-gold',
                '@click' => "onDeleteFile()"
            ])
        </div>
    </div>
</div>

<script type="text/javascript">
    function buttonUpload_{{ $id }}() {
        return {
            fileName_{{ $id }}: '{{ $file_info ? $file_info->file_name : '' }}',
            fileURL_{{ $id }}: '{{ $file_info ? $file_info->original_url : '' }}',
            onDeleteFile() {
                document.getElementById('{{ $id }}').value = null; this.fileName_{{ $id }} = '';
            }
        }
    }
</script>