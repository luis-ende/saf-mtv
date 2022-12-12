<div class="relative flex flex-col text-gray-400 m-0">
    <div x-ref="dnd"
         class="relative flex flex-col text-gray-400 border-2 border-gray-200 border-dashed rounded cursor-pointer">
        <input accept="*.cer" type="file"
               id="certificado_file"
               name="certificado_file"
               class="absolute inset-0 z-40 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
               @change="archivoCert = $event.target.files[0].name"
               @dragover="$refs.dnd.classList.add('border-mtv-gold-light'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
               @dragleave="$refs.dnd.classList.remove('border-mtv-gold-light'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
               @drop="$refs.dnd.classList.remove('border-mtv-gold-light'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
               title=""
        >
        <div class="flex flex-col items-center justify-center p-10 text-center">
            <p class="m-0">Arrastra tu archivo aquí o haz clic para seleccionar.</p>
        </div>
    </div>

    <div class="text-mtv-text-gray my-2" x-show="archivoCert !== null">
        @svg('uiw-paper-clip', ['class' => 'h-3 w-3 inline-block mr-1'])
        <label class="font-bold" x-text="archivoCert"></label>
    </div>
</div>
