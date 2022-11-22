@props(['media_items' => [], 'producto_id' => null])

<div x-data="mediaGallery()"
     x-init="$watch('$store.filesUploaded.hasFilesUploaded', value => { $store.filesUploaded.hasFilesUploaded = false; reloadView() })">
    <div class="flex flex-wrap">
        <div x-show="loading" class="basis-full flex flex-row justify-center my-5">
            <div class="spinner-grow text-secondary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        <template x-for="(item, index) in mediaItems" :key="index">
            <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 m-2 md:basis-1/4 sm:basis-full">
                <video x-show="item.mime_type.startsWith('video')" controls>
                    <source :src="item.original_url" :type="item.mime_type">
                </video>
                <img x-show="item.mime_type.startsWith('image')" class="rounded-t-lg" :src="item.original_url" :alt="item.name">
                <div x-show="!item.mime_type.startsWith('image')" class="flex flex-row justify-content-center">
                    @svg('bx-file', ['class' => 'h-12 w-12 mt-5 text-slate-600'])
                </div>
                <div class="p-3">
                    <a :href="item.original_url"
                       class="mb-3 font-normal text-gray-700 dark:text-gray-400 no-underline"
                       x-text="item.name" target="_blank"></a>
                    <div class="flex flex-row mt-3 justify-content-center">
                        <a :href="item.original_url" class="btn btn-secondary mr-3" :download="item.name" title="Descargar">
                            @svg('icomoon-download', ['class' => 'h-5 w-5'])
                        </a>
                        <button type="button" class="btn btn-primary" @click="removeFile($event, index)" title="Eliminar">
                            @svg('heroicon-s-trash', ['class' => 'h-5 w-5'])
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

<script type="text/javascript">
    function mediaGallery() {
        return {
            mediaItems: {!! json_encode($media_items) !!},
            productoId: {{ $producto_id }},
            loading: false,
            
            removeFile(e, index) {                
                Swal.fire({
                    title: '¿Desea eliminar el archivo?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: '#691C32',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.sendDeleteRequest(e, index);                                                                       
                    }
                });
            },
            sendDeleteRequest(e, index) {
                let mediaItem = this.mediaItems[index];

                if (mediaItem) {
                    this.loading = true;
                    let mediaItemId = mediaItem['id'];
                    fetch('/productos/archivos/' + mediaItemId,
                        {
                            method: 'DELETE',
                            credentials: 'same-origin',
                            headers: {
                                "X-CSRF-Token": '{{ csrf_token() }}',
                            }
                        })
                        .then(res => {
                            this.loading = false;
                            if (res.ok) {
                                this.mediaItems.splice(index, 1);
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: false,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Archivo eliminado.'
                                })
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: false,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: 'No fue posible eliminar el archivo.'
                                })
                            }
                        });
                } 
            },
            reloadView() {
                this.loading = true;
                fetch('/productos/' + this.productoId + '/archivos')
                    .then(res => res.json())
                    .then(res => {
                        this.loading = false;
                        this.mediaItems = res;
                    });
            }
        }
    }
</script>
