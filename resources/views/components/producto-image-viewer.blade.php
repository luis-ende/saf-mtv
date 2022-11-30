@props(['image_url' => null])

<div class="mr-3 mb-3">
    @if($image_url)
    <img class="img-thumbnail" src="{{ $image_url }}" alt="Producto foto">
    @else
    <div class="border rounded border-gray-200 bg-gray-100 flex place-content-center place-items-center mb-3 mr-3">
        @svg('ri-image-fill', ['class' => 'h-64 w-72 p-10 text-slate-200'])
    </div>
    @endif
</div>
