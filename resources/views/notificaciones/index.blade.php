<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="px-6 bg-white border-b border-gray-200">
                <x-page-header-label title="Notificaciones" />
            </div>            
            <div class="py-6 px-12">
                <div x-data="{ 
                    tab: 1,
                    tabActive: 'text-white bg-mtv-secondary hover:text-mtv-secondary', 
                    tabInactive: 'text-white bg-mtv-gold-light hover:text-white' }">
                    <nav class="font-bold text-lg flex md:flex-row xs:flex-col md:space-x-7 md:space-y-0 xs:space-y-4 xs:space-x-0 px-7 mx-auto mb-14 w-3/4">
                        <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-5"
                            :class="tab === 1 ? tabActive : tabInactive"
                            x-on:click.prevent="tab = 1">
                            {{ count($opn_sugeridas) }} Oportunidades sugeridas
                        </button>
                        <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-5"
                           :class="tab === 2 ?  tabActive : tabInactive"
                           x-on:click.prevent="tab = 2">
                           Siguiendo {{ count($opn_guardadas) }} oportunidades
                        </button>
                    </nav>
                    <div x-show="tab === 1" class="px-5">
                        <x-oportunidades.oportunidades-grid
                            :oportunidades="$opn_sugeridas" />
                    </div>
                    <div x-show="tab === 2" class="px-5">
                        <x-oportunidades.oportunidades-grid
                            :oportunidades="$opn_guardadas" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
