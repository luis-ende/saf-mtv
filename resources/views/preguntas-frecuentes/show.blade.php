<x-guest-layout>
    <div class="py-6 md:px-12 xs:px-6 bg-white  flex flex-col">
        <div class="self-center">
            <label class="text-mtv-gray-2 md:text-xl">
                Preguntas frecuentes
            </label>
            <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                ¿Cómo podemos ayudarte?
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
                Conoce las respuesta a las preguntas que otros usuarios nos han hecho.
            </span>
            <span class="md:w-2/5 block text-base xs:text-sm text-center">
                Las preguntas están agrupadas por perfil de usuario. Utiliza los iconos para navegar entre
                éstas. También puedes utilizar el formulario de contacto para comunicarte con nosotros.
            </span>
        </div>
    </div>
    <!-- Menu de botones  -->

    <div class="buttons-questions-desktop">
        <div class="tab-wrapper" x-data="{ activeTab:  -1 }">
            <div class="w-full flex justify-center items-center border-b border-gray-200 pb-6 mb-20">
                <div class="flex flex-row items-center space-x-40 mt-2">
                    <div :class="activeTab === 0 ? 'buttons-content-active' : 'buttons-content'">
                        <label @click="activeTab = 0" class="tab-control " :class="{ 'active': activeTab === 0 }">
                            @svg('general-public',
                            ['class' => 'h-16 w-16 mb-px mt-3 ml-7 '])
                            <p class="text-button">Público en general</p>
                        </label>
                    </div>
                    <div :class="activeTab === 1 ? 'buttons-content-active' : 'buttons-content'">
                        <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                            @svg('register',
                            ['class' => 'h-20 w-20'])
                            <p class="text-button-pd">Proveedores </p>
                        </label>
                    </div>
                    <div :class="activeTab === 2 ? 'buttons-content-active' : 'buttons-content'">
                        <label @click="activeTab = 2" class="tab-control " :class="{ 'active': activeTab === 2 }">
                            @svg('institutions',
                            ['class' => 'h-20 w-20 ml-9'])
                            Instituciones compradoras</label>
                    </div>
                </div>
            </div>

            <!-- submenu botones  -->

            <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
                x-show.transition.in.opacity.duration.600="activeTab === 0">

                <!-- btn 1 -->

                <div class="tab-wrapper w-3/5 mx-64" x-data="{ activeTab:  -1 }">
                    <div class="flex flex-row space-x-3 items-center justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]" type="submit">Conceptos</button>
                        </label>
                        <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                            <button type="submit"
                                :class="activeTab === 1 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]">Compras
                                Públicas</button>
                        </label>
                        <label @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }"><button
                                type="submit" class="hover:bg-[#235b4e]"
                                :class="activeTab === 2 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'">Mi
                                Tiendita
                                Virtual</button></label>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 1">
                        <div>
                            <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                :subcategoria="2" />
                        </div>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 2 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 2">
                        <div>
                            <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                :subcategoria="3" />
                        </div>
                    </div>
                </div>
                <!-- btn 2 -->

            </div>
            <div class="tab-panel" :class="{ 'active': activeTab === 1 }"
                x-show.transition.in.opacity.duration.600="activeTab === 1">
                <div class="tab-wrapper w-3/5 mx-64" x-data="{ activeTab:  -1 }">
                    <div class="flex flex-row space-x-3 items-center justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]">Padrón de
                                proveedores</button>
                        </label>
                        <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                            <button :class="activeTab === 1 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]">Precotizaciones</button>
                        </label>

                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="2" :categoria="2"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 1">
                        <div>
                            <x-preguntas-frecuentes.preguntas-accordion :accordion_key="2" :categoria="2"
                                :subcategoria="2" />
                        </div>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 2 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 2">
                        <div>
                            <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                :subcategoria="3" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-panel" :class="{ 'active': activeTab === 2 }"
                x-show.transition.in.opacity.duration.600="activeTab === 2">

                <div class="tab-wrapper w-3/5 mx-64" x-data="{ activeTab:  -1 }">
                    <div class="flex flex-row space-x-3 items-center justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]">Sistema
                                PAAAPS</button>
                        </label>
                    </div>
                    <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="3" :categoria="3"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- mobile  -->
    <div class="buttons-questions-mobile">
        <div class="tab-wrapper" x-data="{ activeTab:  -1 }">
            <!-- mobile  -->
            <div class="flex justify-center">
                <div :class="activeTab === 0 ? 'buttons-content-active' : 'buttons-content'">
                    <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                        @svg('general-public',
                        ['class' => 'h-16 w-16 mb-px mt-3 ml-7 '])
                        <p class="text-button">Público en general</p>
                    </label>
                </div>
            </div>

            <div class="tab-panel" :class="{ 'active': activeTab === -1 }"
                x-show.transition.in.opacity.duration.600="activeTab === 0">
                <div class="tab-wrapper" x-data="{ activeTab:  0 }">
                    <div class="flex justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]" type="submit">Conceptos</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-center">
                        <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e] mt-4" type="submit">Compras</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 1">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                    :subcategoria="2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <label @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e] mt-4" type="submit">Mi Tiendita Virtual</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 2">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="1" :categoria="1"
                                    :subcategoria="3" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-center">
                <div :class="activeTab === 1 ? 'buttons-content-active' : 'buttons-content'">
                    <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                        @svg('register',
                        ['class' => 'h-20 w-20'])
                        <p class="text-button-pd">Proveedores </p>
                    </label>
                </div>
            </div>

            <div class="tab-panel" :class="{ 'active': activeTab === -1 }"
                x-show.transition.in.opacity.duration.600="activeTab === 1">
                <div class="tab-wrapper" x-data="{ activeTab:  0 }">
                    <div class="flex justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]" type="submit">Padrón de proveedores</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="2" :categoria="2"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-center">
                        <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e] mt-4" type="submit">Precotizaciones</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 1">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="2" :categoria="2"
                                    :subcategoria="2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div :class="activeTab === 2 ? 'buttons-content-active' : 'buttons-content'">
                    <label @click="activeTab = 2" class="tab-control " :class="{ 'active': activeTab === 2 }">
                        @svg('institutions',
                        ['class' => 'h-20 w-20 ml-9'])
                        Instituciones compradoras</label>
                </div>
            </div>

            <div class="tab-panel" :class="{ 'active': activeTab === -1 }"
                x-show.transition.in.opacity.duration.600="activeTab === 2">
                <div class="tab-wrapper" x-data="{ activeTab:  0 }">
                    <div class="flex justify-center">
                        <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                            <button :class="activeTab === 0 ? 'mtv-button-secondary' : 'mtv-button-secondary-white'"
                                class="hover:bg-[#235b4e]" type="submit">Sistema
                                PAAAPS</button>
                        </label>

                    </div>

                    <div class="tab-panel flex justify-center" :class="{ 'active': activeTab === -1 }"
                        x-show.transition.in.opacity.duration.600="activeTab === 0">
                        <div>
                            <div>
                                <x-preguntas-frecuentes.preguntas-accordion :accordion_key="3" :categoria="3"
                                    :subcategoria="1" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Formulario  -->
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
    <form id="contacto" method="POST"
          action="{{ route('preguntas-frecuentes-form.store') }}">
        @csrf
        <div class="flex flex-col mb-20">
            <div class="mx-auto lg:flex justify-center w-3/5">
                <div class="mtv-input-wrapper mr-3 basis-1/3">
                    <input type="text" class="mtv-text-input" id="nombre" name="nombre" maxlength="150" required>
                    <label class="mtv-input-label" for="nombre">Nombre</label>
                </div>
                <div class="mtv-input-wrapper mr-3 basis-1/3">
                    <input type="text" class="mtv-text-input" id="ubicacion" name="ubicacion" maxlength="255" required>
                    <label class="mtv-input-label" for="ubicacion">Alcaldía o Ciudad</label>
                </div>
                <div class="mtv-input-wrapper basis-1/3">
                    <input type="email" class="mtv-text-input" id="email" name="email" required>
                    <label class="mtv-input-label" for="email">Correo electrónico</label>
                </div>
            </div>
            <div class="mx-auto lg:flex justify-center w-3/5">
                <div class="w-auto lg:flex flex-col w-1/3 pr-4">
                    <div class="flex mt-3 mb-3">
                        <input type="radio" class="self-center mr-4 focus:ring-slate-200" id="tipo_persona_fisica"
                            name="tipo_persona" value="F" checked>
                        <label class="mr-3 text-mtv-gray text-sm" for="tipo_persona_fisica">Persona Física</label>
                        <input type="radio" class="self-center mr-4 ml-4 focus:ring-slate-200" id="tipo_persona_moral"
                            name="tipo_persona" value="M">
                        <label class="text-mtv-gray text-sm" for="tipo_persona_moral">Persona Moral</label>
                    </div>
                    <div>
                        <div class="mtv-input-wrapper">
                            <select class="mtv-text-input" id="tipo_empresa" name="tipo_empresa">
                                <option value="0">Tipo de empresa</option>
                                @foreach($tipos_empresa as $tipo_empresa)
                                <option value="{{ $tipo_empresa['id'] }}">{{ $tipo_empresa['tipo_pyme'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3">
                    <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="mensaje" name="mensaje" rows="3" cols="50"
                            required></textarea>
                        <label class="mtv-input-label" for="mensaje">Mensaje</label>
                    </div>
                </div>
            </div>
            <div :class="{'fixed bottom-0 left-0 bg-white w-full border-t-2': filtrosModalOpen}"
                class="flex flex-row space-x-3 items-center justify-center">
                <button type="submit" class="mtv-button-secondary">Enviar mensaje</button>
            </div>
        </div>
    </form>
</x-guest-layout>