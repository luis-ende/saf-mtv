@props(['oportunidad' => null, 'procedimiento_cerrado' => false])

@php($apiRoute = route("oportunidades-negocio-bookmarks.update", [$oportunidad->id]))
<button type="button"             
        x-data="oportunidadNegocioBookmarks"
        x-init="initBookmarks(@js($oportunidad->num_bookmarks), @js($oportunidad->alerta_estatus), @js($procedimiento_cerrado))"
        class="my-0"
        :class="currentColor"
        @guest        
            @php($queryString = count(request()->query()) > 0 ? '&' . http_build_query(request()->query()) : '')
            @php($loginRuta = route('login') . '?url=oportunidades_negocio' . $queryString)
            @click="showMessage(@js($loginRuta), @js(route('registro-inicio')))"
        @endguest
        @auth
            @click="toggleBookmark(@js($apiRoute), @js(csrf_token()))"
        @endauth
>    
    @svg('bi-bookmark-heart', ['x-show' => '!bookmarkActivo', 'class' => 'w-6 h-6 inline-block mr-2 stroke-2'])
    @svg('bi-bookmark-heart-fill', ['x-show' => 'bookmarkActivo', 'class' => 'w-6 h-6 inline-block mr-2 stroke-2'])
    <span x-show="numBookmarks > 0" x-text="numBookmarks + ' '"></span>
    <span>Me gusta</span>
</button>