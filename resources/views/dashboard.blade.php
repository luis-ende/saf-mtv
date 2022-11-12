<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-fit">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-[42rem]">
                <div class="p-6 bg-white border-b border-gray-200">
                    ¡Bienvenido <strong>{{ Auth::user()->persona->nombre_o_razon_social() }}</strong>!
                </div>
                <div class="p-6">
                    <div class="card p-0 mb-5">
                        <div class="card-header">
                            <label class="text-[#691C32] font-bold">Oportunidades de negocio</label>
                        </div>
                        <div class="card-body row g-3">
                        </div>
                    </div>
                    <div class="card p-0 mb-5">
                        <div class="card-header">
                            <label class="text-[#691C32] font-bold">Me interesa</label>
                        </div>
                        <div class="card-body row g-3">
                        </div>
                    </div>
                    <div class="card p-0 mb-5">
                        <div class="card-header">
                            <label class="text-[#691C32] font-bold">Otros</label>
                        </div>
                        <div class="card-body row g-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
