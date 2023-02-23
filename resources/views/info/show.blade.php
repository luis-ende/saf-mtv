<x-guest-layout>
    <div class="information-container">
        <p class="information-container-title">Aprende cómo venderle a la CDMX</p>
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
        <p class="information-container-subtitle">Si te has preguntado cómo venderle al Gobierno, qué requisitos y
            documentos debes reunir,
            continúa leyendo.</p>
        <p class="information-container-message">El Gobierno de la Ciudad de México adquiere a través de cada una de sus
            <a href="#" class="text-[#BC955C] hover:text-[#8B1232]">Instituciones compradoras</a>, una amplia variedad
            de bienes y servicios año con año, lo cual brinda la oportunidad a personas
            físicas y morales de convertirse en proveedores del Gobierno. Venderle a la CDMX representa grandes
            beneficios para tu negocio, por eso en MI TIENDITA VIRTUAL buscamos apoyarte para incrementar tu cartera
            de clientes a nivel gobierno y te damos las herramientas para iniciar esta meta.
        </p>
        <div class="back-home">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            <a href="{{ route('homepage') }}"> Página de inicio</a>
        </div>
        <p class="icon-message">Da clic en los iconos para desplegar la información</p>
    </div>
    <!-- Refactoring -->

    <div class="tab-wrapper" x-data="{ activeTab:  -1}">
        <div class="buttons-container">
            <div class="button-container">
                <label @click="activeTab = 0" class="tab-control" :class="{ 'active': activeTab === 0 }">
                    @svg('register',
                    ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point-df'])
                    Regístrate en Mi Tiendita Virtua</label>
            </div>
            <div class="button-container">
                <label @click="activeTab = 1" class="tab-control" :class="{ 'active': activeTab === 1 }">@svg('search',
                    ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Encuentra una Oportunidad de negocio</label>
            </div>
            <div class="button-container">
                <label @click="activeTab = 2" class="tab-control" :class="{ 'active': activeTab === 2 }">
                    @svg('provider',
                    ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Tramita tu constancia en el Padrón de Proveedores</label>
            </div>
            <div class="button-container">
                <label @click="activeTab = 3" class="tab-control" :class="{ 'active': activeTab === 3 }">
                    @svg('document',
                    ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Documentos para participar en un procedimiento</label>
            </div>
        </div>
        <!-- item 1 -->
        <div class="tab-panel" :class="{ 'active': activeTab === 0 }"
            x-show.transition.in.opacity.duration.600="activeTab === 0">
            <div class="item-content-desktop">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icons-content">
                        @svg('lineawesome-user-check-solid', ['class' => 'h-14 w-14 '])
                        <div class="line-divider"></div>
                        @svg('store', ['class' => 'h-16 w-16'])
                    </div>
                    <div class="content-card-items">
                        <div class="card-items">
                            <p class="title">Regístrate en Mi Tiendita Virtual</p>
                            <p class="message">Esta plataforma te permite tener <strong>acceso a la información de
                                    Contrataciones Públicas de la CDMX</strong> y, de acuerdo a tu perfil, se te
                                <strong>sugerirán oportunidades de negocio</strong>. Para registrarte sólo requieres RFC
                                con
                                homoclave y un correo electrónico, así como los datos generales de tu negocio.
                            </p>
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">Regístrate aquí</a>
                                @svg('arrow-link')
                            </div>
                        </div>
                        <div class="card-items">
                            <p class="title">Promueve tus productos</p>
                            <p class="message">Al registrarte podrás <strong>crear tu Tiendita Virtual</strong> y así
                                las
                                Instituciones compradoras podrán conocer tus productos y contactarte.
                                Además, puedes compartir el enlace con tus clientes y prospectos.</p>
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">Crea tu Tiendita Virtual</a>
                                @svg('arrow-link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- item 2 -->
        <div class="tab-panel" :class="{ 'active': activeTab === 1 }"
            x-show.transition.in.opacity.duration.600="activeTab === 1">
            <div class="item-content-desktop">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icons-content">
                        @svg('tag-search')
                        <div class="line-divider"></div>
                        @svg('favorite-heart')
                    </div>
                    <div class="content-card-items">
                        <div class="card-items">
                            <p class="title">Busca tu bien o servicio</p>
                            <p class="message">Ingresa a “Mi Tiendita Virtual” y <strong>conoce todas las oportunidades
                                    de
                                    negocio</strong> que ofrece el Gobierno de la Ciudad de México <strong>con base en
                                    los
                                    bienes o servicios que ofrece tu negocio</strong>. Consulta las características del
                                procedimiento
                                de tu interés (fechas, tipo de procedimiento, bases, entre otros).</p>
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">Oportunidades de negocio</a>
                                @svg('arrow-link')
                            </div>
                        </div>
                        <div class="card-items">
                            <p class="title">Guarda las oportunidades de negocio de tu interés</p>
                            <p class="message">Al registrarte recibirás notificaciones de nuevas oportunidades
                                <strong>de
                                    acuerdo a tu Perfil
                                    y tu Tiendita Virtual,</strong> además podrás guardar las que sean de tu interés.
                            </p>
                            <div class="d-flex align-items-center">
                                <a href="#" class="mr-3">Favoritos</a>
                                @svg('arrow-link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- item 3 -->
        <div class="tab-panel" :class="{ 'active': activeTab === 2 }"
            x-show.transition.in.opacity.duration.600="activeTab === 2">
            <div class="item-content-desktop">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icons-content">
                            <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 1.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v7.736a.75.75 0 101.5 0V1.75A1.75 1.75 0 0011.25 
                                    0h-8.5A1.75 1.75 0 001 1.75v11.5c0 .966.784 1.75 1.75 1.75h3.17a.75.75 0 000-1.5H2.75a.25.25 0 01-.25-.25V1.75zM4.75 4a.75.75 0 
                                    000 1.5h4.5a.75.75 0 000-1.5h-4.5zM4 7.75A.75.75 0 014.75 7h2a.75.75 0 010 1.5h-2A.75.75 0 014 7.75zm11.774 3.537a.75.75 0 
                                    00-1.048-1.074L10.7 14.145 9.281 12.72a.75.75 0 00-1.062 1.058l1.943 1.95a.75.75 0 001.055.008l4.557-4.45z">
                                </path>
                            </svg>
                        </div>
                        <div class="content-card-items">
                            <div class="card-items">
                                <p class="title">Regístrate en Padrón de Proveedores</p>
                                <p class="message">Si encontraste alguna oportunidad de negocio y algún procedimiento es
                                    de tu
                                    interés, tramita tu <a href="#"
                                        class="text-[#BC955C] hover:text-[#8B1232] text-decoration-underline">Constancia
                                        de
                                        Registro en el Padrón de Proveedores</a> de la
                                    Administración Pública de la Ciudad de México.</p>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">Tramita tu constancia</a>
                                    @svg('arrow-link')
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="admin-title">Documentación requerida para tramitar la constancia en el padrón de
                        proveedores</p>
                    <div class="documents-table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="hide"></th>
                                    <th class="bg-green">PERSONA FÍSICA</th>
                                    <th class="bg-gold">PERSONA MORAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-gray">
                                        1. Identificación oficial (INE vigente, pasaporte vigente o cédula
                                        profesional)
                                    </td>
                                    <td class="tick">Contribuyente</td>
                                    <td class="tick-gold">Representante Legal</td>
                                </tr>
                                <tr>
                                    <td class="text-gray">Acta de Nacimiento</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">3. Acta constitutiva</td>
                                    <td></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">4. Protocolizaciones (si aplica)</td>
                                    <td></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">5. Poder notarial (si aplica)</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">
                                        6. Comprobante de domicilio vigente (con domicilio en la CDMX)
                                    </td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">7. Comprobante de domicilio fiscal vigente</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">8. Comprobante de alta ante el SAT</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">9. Constancia de Situación Fiscal vigente</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">10. Declaración anual de ISR del ejercicio anterior</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">11. Registro ante el IMSS e INFONAVIT</td>
                                    <td class="tick">Si aplica</td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                                <tr>
                                    <td class="text-gray">12. Certificado e.firma del proveedor emitido por el SAT</td>
                                    <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                    <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8 ml-8 '])</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- item 4 -->
        <div class="tab-panel" :class="{ 'active': activeTab === 3 }"
            x-show.transition.in.opacity.duration.600="activeTab === 3">
            <div class="item-content-desktop">
                <div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="icons-content">
                            @svg('calculator', ['class' => 'h-14 w-14 '])
                            <div class="line-divider"></div>
                            @svg('document-check', ['class' => 'h-14 w-14 '])
                        </div>

                        <div class="content-card-items">
                            <div class="card-items">
                                <p class="title">Cotiza tu Bien o Servicio</p>
                                <p class="message">Al tener tu constancia de Padrón de Proveedores vigente y dependiendo
                                    el tipo
                                    de procedimiento, puedes cotizar el bien o servicio que la Istitución compradora
                                    desee
                                    adquirir.
                                    <strong>Cotiza por medio del sistema de requisiciones del Gobierno de la
                                        CDMX.</strong>
                                </p>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">Ir al sistema de Requisiciones</a>
                                    @svg('arrow-link')
                                </div>
                            </div>
                            <div class="card-items">
                                <p class="title">Conoce las bases del procedimiento</p>
                                <p class="message">En caso de resultar participante, con base en las características del
                                    procedimiento estipuladas por la Institución compradora, sigue el proceso
                                    correspondiente.
                                </p>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="mr-3">Directorio de Instituciones compradoras</a>
                                    @svg('arrow-link')
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="title-doc-request">Documentación requerida para participar en un procedimientos </p>
                    <div class="d-flex justify-content-evenly content-crd">
                        <div class="documents-card">
                            <div class="accordion-item">
                                <h2 class="accordion-header admin-title" id="flush-headingOne">
                                    <button class="accordion-button collapsed hover:text-[#BC955C]" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                        ADMINISTRATIVA Y LEGAL
                                        <svg class="w-6 h-6" fill="currentColor" style="margin-left:10px"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                            </path>
                                        </svg>
                                    </button>
                                </h2>
                                <div class="doc-divider"></div>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body border-0">
                                        <p class="admin-subtitle">Documentación de identidad del proveedor:</p>
                                        <ul>
                                            <li class="bullets">Acta nacimiento / constitutiva</li>
                                            <li class="bullets">Identificación oficial Contribuyente /Representante</li>
                                        </ul>
                                        <div class="line-dot-divider"></div>
                                        <p class="admin-subtitle">Documentación fiscal</p>
                                        <ul>
                                            <li class="bullets">Comprobante de domicilio</li>
                                            <li class="bullets">Constancia de identificación fiscal</li>
                                            <li class="bullets">Constancia en el Padrón de Proveedores</li>
                                            <li class="bullets">Alta de cuenta de cheques</li>
                                        </ul>
                                        <div class="line-dot-divider"></div>
                                        <p class="admin-subtitle">Documentación requerida por la Institución compradora
                                        </p>
                                        <ul>
                                            <li class="bullets">Manifiestos relacionados</li>
                                            <li class="bullets">Otros (consultar con la Institución compradora
                                                solicitante)</li>
                                        </ul>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Directorio CDMX</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                        <div class="line-dot-divider"></div>
                                        <p class="bullets"><strong>NOTA:</strong>
                                            La Constancia de Registro en el Padrón de
                                            Proveedores y el Alta de cuenta de cheques en una
                                            institución bancaria son documentos obligatorios.
                                            Inicia el trámite de forma oportuna para contar con
                                            estos cuando desee participar en un procedimiento.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="documents-card">
                            <div class="accordion-item">
                                <h2 class="accordion-header admin-title" id="flush-headingTwo">
                                    <button class="accordion-button collapsed hover:text-[#BC955C]" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                        TÉCNICA
                                        <svg class="w-6 h-6" fill="currentColor" style="margin-left:55%"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                            </path>
                                        </svg>
                                    </button>
                                </h2>
                                <div class="doc-divider"></div>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body border-0">
                                        <p class="admin-subtitle">Documentación técnica</p>
                                        <ul>
                                            <li>Especificaciones técnicas del bien o servicio</li>
                                            <li>Manifiestos relacionados requeridos por la Institución compradora</li>
                                            <li>Otros</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="documents-card">
                            <div class="accordion-item">
                                <h2 class="accordion-header admin-title" id="flush-headingThree">
                                    <button class="accordion-button collapsed hover:text-[#BC955C]" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                        ECONÓMICA
                                        <svg class="w-6 h-6" fill="currentColor" style="margin-left:45%"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                            </path>
                                        </svg>
                                    </button>
                                </h2>
                                <div class="doc-divider"></div>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body border-0">
                                        <p class="admin-subtitle">Documentación por parte del proveedor</p>
                                        <ul>
                                            <li>Propuesta económica (cotización)</li>
                                        </ul>
                                        <div class="line-dot-divider"></div>
                                        <p class="admin-subtitle">Documentación por parte de la Institución compradora
                                        </p>
                                        <ul>
                                            <li>Manifiestos relacionados que requiera</li>
                                            <li>Otros</li>
                                        </ul>
                                        <div class="line-dot-divider"></div>
                                        <p class="bullets"><strong>NOTA:</strong>
                                            La documentación y características
                                            requeridos para participar en algún procedimiento
                                            serán establecidas por las Istituciones compradoras con base en los
                                            procesos que esta estipule.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cares-line"></div>

    <!-- mobile -->

    <div class="acordion-mobile">
        <div class="accordion-item">
            <div class="accordion-header" id="flush-headingOne">
                <div class="button-container">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                        aria-expanded="false" aria-controls="flush-collapseOne">
                        @svg('register',['class' => ' h-20 w-20 svg-mobile'])
                        Regístrate en Mi Tiendita Virtual
                    </button>
                </div>
            </div>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body ">
                    <div class="item-content-mobile ">
                        <div class="d-flex justify-content-center align-items-center content-mobile">
                            <div class="icons-content">
                                @svg('lineawesome-user-check-solid', ['class' => 'h-11 w-11 '])
                                <div class="line-divider"></div>
                                @svg('store', ['class' => 'h-13 w-13'])
                            </div>
                            <div class="content-card-items mt-10">
                                <div class="card-items">
                                    <p class="title">Regístrate en “Mi Tiendita Virtual”</p>
                                    <p class="message">Esta plataforma te permite tener acceso a la información de
                                        Contrataciones Públicas de la CDMX y, de acuerdo a tu perfil, se te sugerirán
                                        oportunidades de negocio. Para registrarte sólo requieres RFC con
                                        homoclave y un correo electrónico, así como los datos generales de tu negocio.
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="mr-3">Regístrate aquí</a>
                                        @svg('arrow-link')
                                    </div>
                                </div>
                                <div class="card-items">
                                    <p class="title">Promueve tus productos </p>
                                    <p class="message">Al registrarte podrás crear tu Tiendita Virtual y así las
                                        Instituciones compradoras podrán conocer tus productos y contactarte. Además,
                                        puedes compartir el enlace con tus clientes y prospectos.</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="mr-3">Crea tu Tiendita virtual</a>
                                        @svg('arrow-link')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header" id="flush-headingTwo">
                    <div class="button-container">
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                            aria-expanded="false" aria-controls="flush-collapseTwo">
                            @svg('search', ['class' => 'h-20 w-20 svg-mobile'])
                            Encuentra una Oportunidad de negocio
                        </button>
                    </div>
                </div>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="item-content-mobile">
                            <div class="d-flex justify-content-center align-items-center content-mobile">
                                <div class="icons-content">
                                    @svg('tag-search', ['class' => 'h-11 w-11'])
                                    <div class="line-divider"></div>
                                    @svg('favorite-heart', ['class' => 'h-9 w-9'])
                                </div>
                                <div class="content-card-items mt-10">
                                    <div class="card-items">
                                        <p class="title">Busca tu bien o servicio</p>
                                        <p class="message">Ingresa a “Mi Tiendita Virtual” y conoce todas las
                                            oportunidades de negocio que ofrece el Gobierno de la Ciudad de México con
                                            base en los bienes o servicios que ofrece tu negocio. Consulta las
                                            características
                                            del procedimiento de tu interés (fechas, tipo de procedimiento, bases, entre
                                            otros).</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Oportunidades de negocio</a>
                                            @svg('arrow-link')
                                        </div>
                                    </div>
                                    <div class="card-items">
                                        <p class="title">Guarda las oportunidades de negocio de tu interés</p>
                                        <p class="message">Al registrarte recibirás notificaciones de nuevas
                                            oportunidades de acuerdo a tu Perfil y tu Tiendita Virtual, además podrás
                                            guardar las que sean de tu interés.</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Favoritos</a>
                                            @svg('arrow-link')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <div class="accordion-header" id="flush-headingThree">
                    <div class="button-container">
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                            aria-expanded="false" aria-controls="flush-collapseThree">
                            @svg('provider', ['class' => 'h-20 w-20 svg-mobile'])
                            Tramita tu constancia en el Padrón de Proveedores
                        </button>
                    </div>
                </div>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center align-items-center content-mobile">
                                <div class="icons-content">
                                    @svg('table-check')
                                </div>
                                <div class="content-card-items mt-10">
                                    <div class="card-items">
                                        <p class="title">Regístrate en Padrón de Proveedores</p>
                                        <p class="message">Si encontraste alguna oportunidad de negocio y algún
                                            procedimiento es de tu
                                            interés, tramita tu <a href="#"
                                                class="text-[#BC955C] hover:text-[#8B1232]">Constancia de Registro en el
                                                Padrón de Proveedores</a> de la
                                            Administración Pública de la Ciudad de México.</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Tramita tu constancia</a>
                                            @svg('arrow-link')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="admin-title"> Documentación Requerida para tramitar la constancia en el padrón de
                                proveedores </p>
                            <div class="accordion-item">
                                <h2 id="flush-headingOne">
                                    <button class="tittle-table hover:text-[##691c20] " type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                        Mostrar documentos
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div>
                                        <div class="p-3 documents-table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="hide"></th>
                                                        <th class="bg-green">PERSONA FÍSICA</th>
                                                        <th class="bg-gold">PERSONA MORAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-gray">
                                                            1. Identificación oficial (INE vigente, pasaporte vigente o
                                                            cédula
                                                            profesional)
                                                        </td>
                                                        <td class="tick">Contribuyente</td>
                                                        <td class="tick-gold">Representante Legal</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">Acta de Nacimiento</td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">3. Acta constitutiva</td>
                                                        <td></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">4. Protocolizaciones (si aplica)</td>
                                                        <td></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">5. Poder notarial (si aplica)</td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">
                                                            6. Comprobante de domicilio vigente (con domicilio en la
                                                            CDMX)
                                                        </td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">7. Comprobante de domicilio fiscal vigente
                                                        </td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">8. Comprobante de alta ante el SAT</td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">9. Constancia de Situación Fiscal vigente
                                                        </td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">10. Declaración anual de ISR del ejercicio
                                                            anterior</td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">11. Registro ante el IMSS e INFONAVIT</td>
                                                        <td class="tick">Si aplica</td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-gray">12. Certificado e.firma del proveedor
                                                            emitido por el SAT</td>
                                                        <td><span class="tick">@svg('check', ['class' => 'h-8 w-8 ml-8
                                                                '])</span></td>
                                                        <td><span class="tick-gold">@svg('check', ['class' => 'h-8 w-8
                                                                ml-8 '])</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" id="flush-headingFour">
                        <div class="button-container">
                            <button type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                aria-expanded="false" aria-controls="flush-collapseFour">
                                @svg('document', ['class' => 'h-20 w-20 svg-mobile'])
                                Encuentra una Oportunidad de Compra
                            </button>
                        </div>
                    </div>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="item-content-mobile">
                                <div>
                                    <div class="d-flex justify-content-center align-items-center content-mobile">
                                        <div class="icons-content">
                                            @svg('calculator')
                                            <div class="line-divider"></div>
                                            @svg('document-check')
                                        </div>

                                        <div class="content-card-items mt-10">
                                            <div class="card-items">
                                                <p class="title">Cotiza tu Bien o Servicio</p>
                                                <p class="message">Al tener tu constancia de Padrón de Proveedores
                                                    vigente y dependiendo el tipo
                                                    de procedimiento, puedes cotizar el bien o servicio que la
                                                    Istitución compradora desee adquirir.
                                                    <strong>Cotiza por medio del sistema de requisiciones del Gobierno
                                                        de la CDMX.</strong>
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="mr-3">Ir al sistema de Requisiciones</a>
                                                    @svg('arrow-link')
                                                </div>
                                            </div>
                                            <div class="card-items">
                                                <p class="title">Conoce las bases del procedimiento</p>
                                                <p class="message">En caso de resultar participante, con base en las
                                                    características del
                                                    procedimiento estipuladas por la Institución compradora, sigue el
                                                    proceso correspondiente.</p>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="mr-3">Directorio de Instituciones compradoras</a>
                                                    @svg('arrow-link')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="title-doc-request">Documentación requerida para participar en un
                                        procedimientos </p>
                                    <div class="d-flex justify-content-evenly content-crd">
                                        <div class="documents-card">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header admin-title" id="flush-headingOne">
                                                    <button class="accordion-button collapsed hover:text-[#BC955C]"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                        aria-controls="flush-collapseOne">
                                                        ADMINISTRATIVA Y LEGAL
                                                        <svg class="w-6 h-6" style="margin-left:10%" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </h2>
                                                <div class="doc-divider"></div>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body border-0">
                                                        <p class="admin-subtitle">Documentación de identidad del
                                                            proveedor:</p>
                                                        <ul>
                                                            <li class="bullets">Acta nacimiento / constitutiva</li>
                                                            <li class="bullets">Identificación oficial Contribuyente
                                                                /Representante</li>
                                                        </ul>
                                                        <div class="line-dot-divider"></div>
                                                        <p class="admin-subtitle">Documentación fiscal</p>
                                                        <ul>
                                                            <li class="bullets">Comprobante de domicilio</li>
                                                            <li class="bullets">Constancia de identificación fiscal</li>
                                                            <li class="bullets">Constancia en el padrón de proveedores
                                                            </li>
                                                            <li class="bullets">Alta de cuenta de cheques</li>
                                                        </ul>
                                                        <div class="line-dot-divider"></div>
                                                        <p class="admin-subtitle">Documentación requerida por la
                                                            Institución compradora</p>
                                                        <ul>
                                                            <li class="bullets">Manifiestos relacionados</li>
                                                            <li class="bullets">Otros (consultar con la Institución
                                                                compradora solicitante)</li>
                                                        </ul>
                                                        <div class="d-flex align-items-center">
                                                            <a href="#" class="mr-3">Directorio CDMX</a>
                                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="#bc955c" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="line-dot-divider"></div>
                                                        <p class="bullets"><strong>NOTA:</strong>La Constancia de
                                                            Registro en el Padrón de
                                                            Proveedores y el Alta de cuenta de cheques en una
                                                            institución bancaria son documentos obligatorios.
                                                            Inicia el trámite de forma oportuna para contar con
                                                            estos cuando desee participar en un procedimiento.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="documents-card">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header admin-title" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed hover:text-[#BC955C]"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                        aria-controls="flush-collapseTwo">
                                                        TÉCNICA
                                                        <svg class="w-6 h-6" fill="currentColor" style="margin-left:60%"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </h2>
                                                <div class="doc-divider"></div>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body border-0">
                                                        <p class="admin-subtitle">Documentación técnica</p>
                                                        <ul>
                                                            <li>Especificaciones técnicas del bien o servicio</li>
                                                            <li>Manifiestos relacionados requeridos por la Institución
                                                                compradora</li>
                                                            <li>Otros</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="documents-card">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header admin-title" id="flush-headingThree">
                                                    <button class="accordion-button collapsed hover:text-[#BC955C]"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                                        aria-controls="flush-collapseThree">
                                                        ECONÓMICA
                                                        <svg class="w-6 h-6" fill="currentColor" style="margin-left:50%"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </h2>
                                                <div class="doc-divider"></div>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body border-0">
                                                        <p class="admin-subtitle">Documentación por parte del proveedor
                                                        </p>
                                                        <ul>
                                                            <li>Propuesta económica (cotización)</li>
                                                        </ul>
                                                        <div class="line-dot-divider"></div>
                                                        <p class="admin-subtitle">Documentación por parte de la
                                                            Institución compradora</p>
                                                        <ul>
                                                            <li>Manifiestos relacionados que requiera</li>
                                                            <li>Otros</li>
                                                        </ul>
                                                        <div class="line-dot-divider"></div>
                                                        <p class="bullets"><strong>NOTA:</strong>La documentación y
                                                            características
                                                            requeridos para participar en algún procedimiento
                                                            serán establecidas por las Istituciones compradoras con base
                                                            en los
                                                            procesos que esta estipule.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>