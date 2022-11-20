@props(['image_url' => null])

<div class="mr-3">
    <div class="border rounded border-gray-200 bg-gray-100 mr-3">
        <img src="{{ $image_url }}" alt="Producto foto"
             class="object-scale-down rounded p-3"
        >
    </div>
</div>
