<div x-data="dataFileDnD()" 
     x-init="$watch('triggerUpdateEvent', value => { $store.filesUploaded.hasFilesUploaded = true })" 
     class="relative flex flex-col text-gray-400 m-0">
    <div x-ref="dnd"
         class="relative flex flex-col text-gray-400 border-2 border-gray-200 border-dashed rounded cursor-pointer">
        <input accept="*" type="file" multiple
                class="absolute inset-0 z-40 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                {{-- @change="addFiles($event)"
                @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');" --}}
                title="" />

        <div class="flex flex-col items-center justify-center p-10 text-center">            
            <p class="m-0">Arrastra y suelta tu archivo aquí o haz clic para seleccionar.</p>
        </div>
    </div>

    {{-- <div class="flex justify-content-center mt-3"> --}}
        <button type="button" class="mtv-button-secondary w-1/4 self-center my-4"
                @click="sendFiles($event)"
                :disabled="isUploading">
            <span x-show="isUploading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            {{-- <span class="ml-1" x-text="isUploading ? 'Enviando...' : 'Guardar'">Utilizar</span> --}}
            Utilizar
        </button>
    {{-- </div> --}}
</div>
