<x-app-layout :show_main_menu="false" :with_background_color="true" :show_menu_bar="false">
    @section('page_title', 'Registro Mi Tiendita Virtual')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header',
                       ['titulo' => 'Tu negocio',
                        'subtitulo' => 'Datos y perfil de tu negocio. Estos datos los requerimos para conocer mejor tu negocio y dirigir comunicados de tu interés.'])
            <div class="px-6">
                <x-perfil-negocio.perfil-negocio-form
                    :persona="$persona"
                    :cat_paises="$cat_paises"
                    :tipos_vialidad="$tipos_vialidad"
                    :grupos_prioritarios="$grupos_prioritarios"
                    :tipos_pyme="$tipos_pyme"
                    :sectores="$sectores"
                    :mode="__('registro')"
                />
            </div>
        </div>
    </div>
</x-app-layout>
