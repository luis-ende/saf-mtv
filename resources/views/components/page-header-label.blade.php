@props(['title' => ''])

<div class="p-6 bg-white md:text-2xl xs:text-base">
    <div class="uppercase text-mtv-primary font-bold">
        {{ $title }}        
    </div>
    <div class="text-base">
        {{ $slot }}
    </div>
</div>