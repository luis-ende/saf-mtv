@props(['image_url' => null])

<div class="p-5">
    @if($image_url)
    <img class="img-thumbnail w-full h-full" src="{{ $image_url }}" alt="Producto foto principal">
    @else
    <div class="border rounded border-gray-200 bg-gray-100 flex place-content-center place-items-center">
        @svg('ri-image-fill', ['class' => 'h-64 w-72 p-10 text-slate-200'])
    </div>
    @endif
</div>
