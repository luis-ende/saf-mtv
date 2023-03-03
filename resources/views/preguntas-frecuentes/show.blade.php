<x-guest-layout>
    <div class="py-6 md:px-12 xs:px-6 bg-white  flex flex-col">
        <div class="self-center">
            <label class="text-mtv-gray-2 md:text-xl">
                Buscador de
            </label>
            <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                Oportunidades para venderle a la CDMX
            </h1>
        </div>
        <div class="self-center">
            <div class="flex flex-row space-x-4 mt-2">
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
            </div>
        </div>
        <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
            <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                Identifica qué productos y servicios compra la CDMX.
            </span>
            <span class="md:w-2/5 block text-base xs:text-sm text-center">
                Las preguntas están agrupadas por perfil de usuario. Utiliza los iconos para navegar entre
                éstas. También puedes utilizar el formulario de contacto para comunicarte con nosotros.
            </span>
        </div>
    </div>

    <div class="tab-wrapper" x-data="{ activeTab:  -1 }">
        <div class="w-full flex justify-center border-b border-gray-200 pb-6 mb-20">
            <div class="flex flex-row items-center space-x-40 mt-2  w-1/2">
                <label @click="activeTab = 0"
                    class="tab-control group hover:text-base hover:text-mtv-secondary  hover:font-bold"
                    :class="{ 'active': activeTab === 0 }">
                    @svg('general-public',
                    ['class' => 'h-16 w-16 mb-px mt-3 ml-7 group-hover:scale-150 group-hover:mb-6'])
                    Público en general
                </label>
                <label @click="activeTab = 1"
                    class="tab-control group hover:text-base hover:text-mtv-secondary  hover:font-bold"
                    :class="{ 'active': activeTab === 1 }">
                    @svg('register',
                    ['class' => 'h-20 w-20 group-hover:scale-150 group-hover:mb-6'])
                    Proveedores</label>
                <label @click="activeTab = 2"
                    class="tab-control group hover:text-base hover:text-mtv-secondary  hover:font-bold"
                    :class="{ 'active': activeTab === 2 }">
                    @svg('institutions',
                    ['class' => 'h-20 w-20 ml-9 group-hover:scale-150 group-hover:mb-6 group-hover:ml-18'])
                    Instituciones compradoras</label </label>
            </div>
        </div>
        <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
            x-show.transition.in.opacity.duration.600="activeTab === 0">
            <p>This is the example content of the first tab.</p>
        </div>
        <div class="tab-panel" :class="{ 'active': activeTab === 1 }"
            x-show.transition.in.opacity.duration.600="activeTab === 1">
            <p>The second tab’s example content.</p>
        </div>
        <div class="tab-panel" :class="{ 'active': activeTab === 2 }"
            x-show.transition.in.opacity.duration.600="activeTab === 2">
            <p>The content of the third and final tab in this set.</p>
        </div>
    </div>

    <div class="py-6 md:px-12 xs:px-6 bg-white  flex flex-col">
        <div class="self-center">
            <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                Queremos escucharte
            </h1>
        </div>
        <div class="self-center">
            <div class="flex flex-row space-x-4 mt-2">
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
            </div>
        </div>
        <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
            <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                Contáctanos utilizando el formulario.
            </span>
            <span class="md:w-1/5 block text-base xs:text-sm text-center">
                Horario de atención de Lunes a Viernes de 9:00 - 15:00 hrs.
                Tiempo promedio de respuesta: 24 hrs.
            </span>
        </div>
    </div>
</x-guest-layout>