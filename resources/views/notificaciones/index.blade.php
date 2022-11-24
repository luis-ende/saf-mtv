<x-app-layout>
    <div class="py-6 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-slate-800 font-bold text-2xl p-6 bg-white border-b border-gray-200">
                    @svg('gmdi-notifications-active-o', ['class' => 'h-7 w-7 inline-block mr-1'])
                    Centro de notificaciones
                </div>
                <div class="p-6 bg-[#F7F3ED] border-b border-gray-200 text-base">
                    Con la información que proporcionaste, seleccionamos notificaciones que te pueden interesar.
                </div>
                <div class="px-5">
                    <div class="text-xl text-slate-900 font-bold mt-3">
                        @svg('sui-message', ['class' => 'h-5 w-5 inline-block mr-1'])
                        Tus notificaciones
                    </div>
                    <div class="mb-5">
                        <x-notificaciones-table />
                    </div>
                    <div class="text-xl text-slate-900 font-bold">
                        @svg('uiw-like-o', ['class' => 'h-5 w-5 inline-block mr-1'])
                        De tu interés
                    </div>
                    <div>
                        <x-notificaciones-table
                            :icon_like="false"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
