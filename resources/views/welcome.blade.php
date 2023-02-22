<style>
.menu-mtv {
    position: sticky;
    top: 0;
    z-index: 4;
}

.menu-mtv-border {
    position: sticky;
    top: 50px;
    z-index: 4;
}

.button-back-up {
    width: 60px;
    height: 60px;
    color: #9F2241;
    position: fixed;
    bottom: 50px;
    right: 50px;
    cursor: pointer;
    transform: scale(0);
}
</style>



<x-guest-layout>
    <div class="flex flex-col" style="background-color:#FFFFFF" id="back-main">
        <!-- Carousel -->
        <div class="h-96">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/fakeBanner_01.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/fakeBanner_02.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/fakeBanner_03.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previo</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </div>
    <div class="menu-bottom">
        <div class="card-menu-bottom">
            <div class="circle">
                @svg('provider', ['class' => 'h-20 w-20 '])
            </div>
            <p class="message-one">Quiero ser proveedor</p>
            <p class="message-second">Aprende cómo venderle a la CDMX</p>
            <button onclick="window.location='{{ route('flujograma.show') }}'">Requisitos y documentos</button>
        </div>
        <div class="card-menu-bottom">
            <div class="circle">
                @svg('product', ['class' => 'h-20 w-20 '])
            </div>
            <p class="message-one">Ofrece tus productos</p>
            <p class="message-second">Registra tus Bienes y/o Servicios</p>
            <button>Mi Tiendita Virtual</button>
        </div>
        <div class="card-menu-bottom">
            <div class="circle">
                @svg('planning', ['class' => 'h-20 w-20 '])
            </div>
            <p class="message-one">Planeación anual</p>
            <p class="message-second">Compras programadas para el próximo año</p>
            <button>Calendario de compras</button>
        </div>
        <div class="card-menu-bottom">
            <div class="circle">
                @svg('search-icon', ['class' => 'h-20 w-20 '])
            </div>
            <p class="message-one">Buscador de oportunidades</p>
            <p class="message-second">Oportunidades para venderle a la CDMX</p>
            <button>Oportunidades de negocio</button>
        </div>
    </div>
    <!-- Menú de mi Tiendita virtual-->
    <div
        class="d-none d-xl-block flex flex-row bg-[#9F2241] space-x-7 py-3 px-5 md:justify-center md:flex-wrap menu-mtv">
        <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#">Inicio</a>
        <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#virtual-store">¿Qué es
            Mi Tiendita Virtual</a>
        <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center"
            href="#for-virtual-store">¿Para quién es?</a>
        <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center"
            href="#how-part-virtual-store">¿Cómo formo parte?</a>
        <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#">¿Tienes dudas?</a>
    </div>
    <div class="d-none d-xl-block w-full h-2 bg-mtv-gold-light menu-mtv-border"></div>

    <!-- sección qué es mtv-->
    <div class="what-mtv" id="virtual-store">
        <div class="what-mtv-left ">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="{{ asset('assets/movil_01.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="{{ asset('assets/movil_02.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/movil_03.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/movil_04.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="what-mtv-right">
            <p class="what-mtv-right-title">¿Qué es mi tiendita virtual?</p>
            <p class="what-mtv-mesagge">Es una plataforma diseñada para facilitar la interacción entre empresarios
                (personas
                físicas o morales) e Instituciones compradoras (Organismos Autónomos, Dependencias,
                Órganos Desconcentrados, Alcaldías y Entidades de la Ciudad de México).<br><br>

                Esta plataforma tiene tres funcionalidades principales: creación de tu <stong>Tiendita Virtual</stong>
                (Catálogo de Bienes / Servicios), <strong>Calendario anual de compras y Buscador de
                    oportunidades</strong> para participar en procedimientos y venderle al Gobierno de la CDMX*.</p>
            <p class="what-mtv-right-title-second">Promueve tu producto o servicio</p>
            <p class="what-mtv-mesagge">Al <strong>crear tu Tiendita Virtual</strong> tienes la posibilidad de
                <strong>hacer visible tu negocio y
                    promocionarte con las Instituciones compradoras de la CDMX</strong>. Te pueden contactar
                para solicitarte más información e <strong>invitarte a participar en los procedimientos de
                    carácter público</strong> (licitaciones, invitaciones restringidas y adjudicaciones directas) para
                la adquisición de aquellos bienes o servicios que ofrezcas y requieran.<br><br>
                Al mismo tiempo, tu <strong>Tiendita Virtual</strong> se convertirá en <strong>una herramienta de
                    venta</strong> la
                cual podrás <strong>compartir con tus clientes y prospectos</strong>.
            </p>
            <button class=" hover hover:text-[#9f2241] hover:bg-[#ddc9a3]" type="button"
                onclick="window.location='{{ route('registro-inicio') }}'">Quiero Registrarme @svg('circle-arrow-fill',
                ['class' => 'd-inline ml-2'])</button>
            <p class="what-mtv-mesagge-note">*Para participar en los procedimientos se requiere constancia vigente en
                Padrón de Proveedores.</p>
        </div>
    </div>
    <!-- sección para quién es mtv-->
    <div class="for-mtv" id="for-virtual-store">
        <div class="image-container d-none d-xl-block">
            <div class="image-container-top">
                <img src="{{ asset('assets/img_01.jpg') }}" />
                <img src="{{ asset('assets/img_02.jpg') }}" />
            </div>
            <div class="image-container-bottom">
                <img src="{{ asset('assets/img_03.jpg') }}" />
                <img class="image-responsive" src="{{ asset('assets/img_04.jpg') }}" />
            </div>
        </div>
        <div class="for-mtv-information-container">
            <div class="for-mtv-information-container-top">
                <p class="for-mtv-information-container-top-title">¿Para quién es Mi Tiendita Virtual?</p>
                <p class="for-mtv-information-container-top-message"> Es para empresarios o público en general que
                    quieren conocer cómo venderle al Gobierno de la CDMX
                    pero no saben por dónde empezar. Esta plataforma los ayudará en sus primeros pasos y ya que estén
                    listos para venderle a la CDMX, podrán inscribirse al Padrón de Proveedores. En los siguientes
                    recuadros explora con qué perfil te identificas y cómo te ayuda Mi Tiendita Virtual.</p>
            </div>
            <div class="for-mtv-information-container-bottom">
                <div class="for-mtv-information-container-bottom-red">
                    <p class="for-mtv-information-title">No soy proveedor</p>
                    <p class="for-mtv-information-notes">(No le he vendido al Gobierno de la CDMX)</span>
                    <ul>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Conoce cómo venderle a la CDMX.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Identifica los requisitos y documentos
                            para ser proveedor.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Descubre si tu Bien/Servicio lo compra la
                            CDMX.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Crea tu Tiendita Virtual (para registrarte
                            sólo requieres tu RFC con homoclave).</li>
                    </ul>
                    <div class="divider"></div>
                    <div class="for-mtv-information-button-container">
                        <button class=" hover hover:text-[#600a21] hover:bg-[#ddc9a3]" type="button"
                            onclick="window.location='{{ route('registro-inicio') }}'">Regístrate</button>
                    </div>
                </div>
                <div class="for-mtv-information-container-bottom-gold">
                    <p class="for-mtv-information-title-gold">Ya soy proveedor</p>
                    <p class="for-mtv-information-notes">(estoy registrado en Padrón de proveedores)</p>
                    <p class="for-mtv-information-text">No es necesario que te registres. Ingresa con tu
                        usuario de Padrón de Proveedores:</p>
                    <ul>
                        <li> @svg('circle-check', ['class' => 'd-inline mr-2'])Crear tu Tiendita virtual.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Conocer qué planea comprar la CDMX el
                            siguiente año y prepara tu documentación.</li>
                        <li> @svg('circle-check', ['class' => 'd-inline mr-2'])Buscar oportunidades de negocio y guarda
                            los
                            procedimientos de tu interés.</li>
                    </ul>
                    <div class="for-mtv-information-button-container">
                        <button>Ingresa</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- sección para cómo formo parte de MTV-->
    <div class="how-part" id="how-part-virtual-store">
        @svg('horizontal-plot',['class' => 'd-none d-xl-block'])
        <div class="how-part-information">
            <p class="how-part-information-title">¿Cómo formo parte de Mi Tiendita Virtual?</p>
            <p class="how-part-information-text">Sólo tienes que registrar tu negocio y al menos un producto. Además
                <strong>con tu registro puedes guardar las
                    oportunidades de negocio de tu interés y de acuerdo a tu perfil y oferta comercial, se te sugerirán
                    oportunidades nuevas</strong>. Todo para que estés al día sobre lo que compra la CDMX.
            </p>
            <button class=" hover hover:text-[#9f2241] hover:bg-[#ddc9a3]" type="button"
                onclick="window.location='{{ route('registro-inicio') }}'">Regístrate aquí</button>
            <p class="how-part-information-title">¿Por qué ser parte de Mi Tiendita Virtual</p>
        </div>
        <div class="why-be-part-of">
            <div class="why-be-part-of-container">
                @svg('package', ['class' => 'h-20 w-20 '])
                <p class="why-be-part-of-container-title">Tiendita virtual</p>
                <p class="why-be-part-of-container-text">Es tu catálogo de Bienes/Servicios
                    para que el Gobierno de la CDMX
                    conozca tu negocio y tu oferta
                    comercial.</p>
            </div>
            <div class="why-be-part-of-container">
                @svg('notification', ['class' => 'h-20 w-20 '])
                <p class="why-be-part-of-container-title">Notificaciones</p>
                <p class="why-be-part-of-container-text">Recibe notificaciones de nuevas
                    oportunidades <strong>de acuerdo a tu Perfil y tu
                        Tiendita Virtual</strong>, además puedes guardar las
                    que sean de tu interés.</p>
            </div>
            <div class="why-be-part-of-container">
                @svg('question', ['class' => 'h-20 w-20 '])
                <p class="why-be-part-of-container-title">Acompañamiento</p>
                <p class="why-be-part-of-container-text">Hemos creado un sitio con la información que te
                    ayuda a dar los primeros pasos para convertirte en
                    proveedor de la CDMX pero si tienes dudas,
                    estamos listos para asesorarte.</p>
            </div>
        </div>
    </div>
    <button class="button-back-up" id="button-back-up" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-bar-up"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z" />
        </svg>
    </button>
    </div>
</x-guest-layout>

<script type="text/javascript">
const buttonUp = document.getElementById("button-back-up")

const arrowBackFunction = () => {
    let currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    if (currentScroll > 0) {
        window.scrollTo(0, 0);
    }
}

buttonUp.addEventListener("click", arrowBackFunction)

let screenWidth = +screen.width
const scrollFunction = (min, max) => {
    window.onscroll = function() {
        let scroll = document.body.scrollTop;
        if (scroll < min || scroll > max) {
            buttonUp.style.transform = "scale(0)"
        } else {
            buttonUp.style.transform = "scale(1)";
        }
    }
}
if (screenWidth < 450) {
    scrollFunction(700, 4700);

} else {
    scrollFunction(500, 2700)
}
</script>