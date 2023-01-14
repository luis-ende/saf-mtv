@props(['href' => '', 'default_icon' => true])

<a href="{{ $href }}"
   download {{ $attributes->merge(['class' => 'mtv-link-download-gold']) }}>
    @if($default_icon)
        @svg('carbon-document-download', ['class' => 'w-7 h-7 inline-block'])
    @endif
    {{ $slot }}
</a>
