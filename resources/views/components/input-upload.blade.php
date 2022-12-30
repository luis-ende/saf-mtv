@props(['name' => 'input_file', 'id' => 'input_label', 'allow_delete' => false])

<div class="relative flex flex-col text-gray-400 m-0" x-data="fileUpload_{{ $id }}()">
    <div x-ref="dnd"
         class="relative flex flex-col text-gray-400 border-2 border-gray-200 border-dashed rounded cursor-pointer">
        <input accept="application/xlsx" type="file"
               id={{ $id }}
               name="{{ $name }}"
               class="absolute inset-0 z-40 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
               @change="upload_{{ $id }} = $event.target.files[0].name"
               @dragover="$refs.dnd.classList.add('border-mtv-gold-light'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
               @dragleave="$refs.dnd.classList.remove('border-mtv-gold-light'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
               @drop="$refs.dnd.classList.remove('border-mtv-gold-light'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
               title=""
        >
        <div class="flex flex-col items-center justify-center p-10 text-center">
            <p class="m-0">Arrastra tu archivo aquí o haz clic para seleccionar.</p>
        </div>
    </div>

    <div class="text-mtv-text-gray my-3 self-center" x-show="upload_{{ $id }} !== null">
        <label class="font-bold" x-text="upload_{{ $id }}"></label>
        @if($allow_delete)
            @svg('sui-cross', [
            'class' => 'h-3 w-3 inline-block ml-3 cursor-pointer',
            '@click' => "document.getElementById('carta_presentacion').value = null; cartaPresentacion = null"
            ])
        @endif
    </div>
</div>

<script type="text/javascript">
    function fileUpload_{{ $id }}() {
        return {
            upload_{{ $id }}: null,
        }
    }
</script>
