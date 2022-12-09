@props(['id' => 'input-image', 'name' => 'input-image', 'image_url' => null])

<div x-data="imageViewer()">
    <div class="bg-gray-50 flex justify-center">
        <div class="h-64 w-44">                        
            <div class="flex place-content-center place-items-center relative">                 
                @svg('carbon-edit', ['class' => 'absolute w-7 h-7 absolute top-8 right-2 p-1 text-mtv-text-gray z-40 bg-gray-50'])            
                @svg('fas-building', ['x-show' => '!imageUrl', 'class' => 'absolute h-48 w-42 bg-gray-200 text-gray-50 p-4 my-3'])            
                <img x-show="imageUrl" :src="imageUrl" alt="Logotipo"
                     class="absolute object-scale-down h-48 w-44"
                >
                <input id="{{ $id }}" name="{{ $name }}"
                       class="inset-0 w-44 h-64 p-0 m-0 outline-none opacity-0 cursor-pointer z-50"
                       type="file" accept="image/*" @change="fileChosen"
                >
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function imageViewer() {
        return {
            imageUrl: '{{ $image_url ? url($image_url) : "" }}',

            fileChosen(event) {
                this.fileToDataUrl(event, src => this.imageUrl = src)
            },

            fileToDataUrl(event, callback) {
                if (! event.target.files.length) return

                let file = event.target.files[0],
                    reader = new FileReader()

                reader.readAsDataURL(file)
                reader.onload = e => callback(e.target.result)
            },
        }
    }

</script>
