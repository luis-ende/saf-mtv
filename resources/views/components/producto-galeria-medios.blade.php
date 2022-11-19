@props(['media' => []])

<div x-data="mediaGallery()">
    <div class="w-full flex flex-col align-items-end px-1 my-3">
        <button type="button" class="btn btn-primary" @click="addItem()">
            @svg('heroicon-m-plus-circle', ['class' => 'h-7 w-7 inline-block mr-1'])
            Agregar
        </button>
    </div>
    <div class="flex flex-wrap">
        <template x-for="(item, index) in media" :key="index">
            <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 m-2 md:basis-1/4 sm:basis-full">
                <img x-if="item.original_url !== ''" class="rounded-t-lg" :src="item.original_url" :alt="item.file_name">
                @svg('ri-image-add-fill', ['x-show' => "item.original_url === ''", 'class' => 'h-10 w-10 text-slate-600'])
                <input :id="'media-item' + index" name="'media-item' + index"
                       class="inset-0 w-44 h-44 p-0 m-0 outline-none opacity-0 cursor-pointer"
                       type="file" accept="image/*" @change="fileChosen">
                <div class="p-5">
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" x-text="item.file_name"></p>
                    <div class="flex flex-row">
                        <button type="button" class="btn btn-secondary mr-3">
                            @svg('icomoon-download', ['class' => 'h-5 w-5'])
                        </button>
                        <button type="button" class="btn btn-primary">
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
            media: {!! json_encode($media) !!},

            addItem() {
                this.media['new'] = {
                        file_name: '',
                        original_url: '',
                    }
            }
        }
    }
</script>
