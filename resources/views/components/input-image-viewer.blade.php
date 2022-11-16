@props(['id' => 'input-image', 'name' => 'input-image'])

<div class="mr-3 mb-2" x-data="imageViewer()">
    <div class="border rounded border-gray-200 bg-gray-100 mr-3 flex justify-center">
        <div class="h-44 w-44 flex place-content-center place-items-center">
            @svg('ri-image-add-fill', ['x-show' => '!imageUrl','class' => 'absolute h-10 w-10 text-slate-600'])
            <img x-show="imageUrl" :src="imageUrl"
                 class="absolute object-scale-down rounded border border-gray-200 h-44 w-44 p-3"
            >
            <input id="{{ $id }}" name="{{ $name }}"
                   class="inset-0 w-44 h-44 p-0 m-0 outline-none opacity-0 cursor-pointer"
                   type="file" accept="image/*" @change="fileChosen">
        </div>
    </div>
</div>

<script type="text/javascript">
    function imageViewer() {
        return {
            imageUrl: '',

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
