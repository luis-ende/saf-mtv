@php($maxNumFotos = 3)

<div class="bg-white p7 rounded w-11/12 mx-auto">
    <div x-data="dataFileDnD()"
         {{--x-init="$watch('triggerUpdateEvent', value => { $store.filesUploaded.hasFilesUploaded = true })"--}}
         x-init="$watch('productoEditado', value => { cargaProductoFotos(value) })"
         class="relative flex flex-col p-4 text-gray-400">
        <div x-ref="dnd"
             class="relative flex flex-col text-gray-400 border-2 border-mtv-gray-2 border-dashed rounded cursor-pointer">
            <input accept="image/png, image/jpeg" type="file" multiple
                   id="producto_fotos" name="producto_fotos[]"
                   class="absolute inset-0 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                   @change="addFiles($event)"
                   @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                   @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                   @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                   title="" />

            <div class="flex flex-col items-center justify-center py-10 text-center">
                @svg('ri-image-add-fill', ['class' => 'w-7 h-7 mr-1 text-mtv-secondary'])
                <p class="m-0">Arrastra aquí tus archivos o haz clic en el recuadro para agregarlos</p>
            </div>
        </div>

        <template x-if="files.length > 0">
            <div class="grid grid-cols-3 gap-4 mt-4 self-center" @drop.prevent="drop($event)"
                 @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                <template x-for="(_, index) in Array.from({ length: files.length })">
                    <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none w-32 h-32"
                         style="padding-top: 100%;" @dragstart="dragstart($event)" @dragend="fileDragging = null"
                         :class="{'border-blue-600': fileDragging == index}" draggable="true" :data-index="index">
                        <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button" @click="remove(index)">
                            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>

                        <template x-if="!files[index]?.hasOwnProperty('original_url')">
                            <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                 x-bind:src="files[index] ? loadFile(files[index]) : null" />
                        </template>

                        <template x-if="files[index]?.hasOwnProperty('original_url')">
                            <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                 x-bind:src="files[index]?.original_url" />
                        </template>

                        <div class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                            <span class="w-full font-bold text-gray-900 truncate"
                                  x-text="files[index]?.name">Cargando</span>
                            <span class="text-xs text-gray-900" x-text="humanFileSize(files[index]?.size)">...</span>
                        </div>

                        <div class="absolute inset-0 z-40 transition-colors duration-300" @dragenter="dragenter($event)"
                             @dragleave="fileDropping = null"
                             :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>

<form id="producto-archivos" enctype="multipart/form-data" method="post">
    @csrf
</form>

<script src="https://unpkg.com/create-file-list"></script>
<script>
    function dataFileDnD() {
        return {
            formData: null,
            files: [],
            productoFotos: [],
            fileDragging: null,
            fileDropping: null,
            triggerUpdateEvent: false,
            humanFileSize(size) {
                const i = Math.floor(Math.log(size) / Math.log(1024));
                return (
                    (size / Math.pow(1024, i)).toFixed(2) * 1 +
                    " " +
                    ["B", "kB", "MB", "GB", "TB"][i]
                );
            },
            remove(index) {
                if (this.files[index].hasOwnProperty('original_url')) {
                    this.files.splice(index, 1);

                    return;
                }

                let files = [...this.files];
                files.splice(index, 1);

                this.files = createFileList(files);
            },
            drop(e) {
                let removed, add;
                let files = [...this.files];

                removed = files.splice(this.fileDragging, 1);
                files.splice(this.fileDropping, 0, ...removed);

                this.files = createFileList(files);

                this.fileDropping = null;
                this.fileDragging = null;
            },
            dragenter(e) {
                let targetElem = e.target.closest("[draggable]");

                this.fileDropping = targetElem.getAttribute("data-index");
            },
            dragstart(e) {
                this.fileDragging = e.target
                    .closest("[draggable]")
                    .getAttribute("data-index");
                e.dataTransfer.effectAllowed = "move";
            },
            loadFile(file) {
                const preview = document.querySelectorAll(".preview");
                const blobUrl = URL.createObjectURL(file);

                preview.forEach(elem => {
                    elem.onload = () => {
                        URL.revokeObjectURL(elem.src); // free memory
                    };
                });

                return blobUrl;
            },
            addFiles(e) {
                const totalFiles = e.target.files.length + this.files.length;

                if (totalFiles <= 3) {
                    const files = createFileList([...this.files], [...e.target.files]);
                    this.files = files;
                }
            },
            clearFiles(){
                this.files = [];
            },
            cargaProductoFotos(productoId) {
                if (productoId) {
                    fetch('/productos/' + productoId + '/fotos')
                        .then(res => res.json())
                        .then(res => {
                            this.files = res;
                        });
                }
            }
        };
    }
</script>
