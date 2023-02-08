@props(['links' => [], 'button_style' => 'mtv-button-secondary-white'])

<a href="{{ $links['whatsapp'] }}" target="popup" alt="Enlace compartir Whatsapp"   
    onclick="window.open('{{ $links['whatsapp'] }}','popup','width=600,height=600'); return false;"
    class="{{ $button_style }} no-underline md:text-base xs:text-sm my-4 flex flex-row items-center">
    @svg('icomoon-whatsapp', ['class' => 'w-5 h-5 mr-3 md:inline xs:hidden'])
    Compartir
</a>