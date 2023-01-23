@props(['links' => [], 'button_style' => 'mtv-button-secondary-white'])

<a href="{{ $links['facebook'] }}" target="popup" alt="Enlace compartir Facebook"   
    onclick="window.open('{{ $links['facebook'] }}','popup','width=600,height=600'); return false;"
    class="{{ $button_style }} no-underline md:text-base xs:text-sm my-4">
    @svg('jam-share-alt', ['class' => 'w-5 h-5 inline-block mr-3 md:inline xs:hidden'])
    Compartir
</a>