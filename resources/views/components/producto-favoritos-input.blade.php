@php($numFavoritos = 0)
<span>
    <a href="#" class="{{ $numFavoritos > 0 ? 'text-mtv-primary hover:fill-mtv-gold' : 'text-mtv-gold hover:fill-mtv-primary' }} no-underline">
        @if($numFavoritos > 0)
            @svg('gmdi-favorite-r', ['class' => 'w-5 h-5 inline-block mr-2'])
        @else
            @svg('gmdi-favorite-border-r', ['class' => 'w-5 h-5 inline-block mr-2'])
        @endif
        {{ $numFavoritos }}
    </a>
</span>