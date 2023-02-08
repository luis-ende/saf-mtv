<div class="border rounded">
    <div class="border-b">
        <label class="text-mtv-primary font-bold py-2 ml-5 text-lg">{{ $title }}</label>
    </div>    
    <div class="mx-3 py-2">
        {{ $slot }}
    </div>                
    @isset($footer)
        <hr class="m-0">
        {{ $footer }}
    @endisset            
</div>
