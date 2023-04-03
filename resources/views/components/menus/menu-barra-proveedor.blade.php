{{-- Clase del componente: app/View/Components/Menus/MenuBarraProveedor.php --}}

<div class="flex flex-row items-baseline">
    <a href="{{ route('centro-notificaciones.index', [1]) }}"
       class="mtv-link-primary mr-9"
       title="Notificaciones">
        @if($tieneOpnSugeridas)
            @svg('fluentui-alert-badge-16-o', ['class' => 'h-7 w-7 inline-block'])
        @else
            @svg('fluentui-alert-32-o', ['class' => 'h-7 w-7 inline-block'])
        @endif
    </a>
    <a href="{{ route('centro-notificaciones.index', [2]) }}"
       class="mtv-link-primary mr-7"
       title="Favoritos">
        @if($tieneOpnGuardadas)
            @svg('bi-bookmark-heart-fill', ['class' => 'h-6 w-6 inline-block'])
        @else
            @svg('bi-bookmark-heart', ['class' => 'h-6 w-6 inline-block'])
        @endif
    </a>
</div>