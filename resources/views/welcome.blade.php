<style>
.menu-mtv {
    position:sticky;
    top: 60px;
}

.menu-mtv-border {
    position:sticky;
    top:114px;
}

.button-back-up {
    width: 60px;
    height: 60px;
    color:#9F2241;
    position:fixed;
    bottom:50px;
    right: 50px;
    cursor:pointer;
    transform: scale(0);
}
</style>



<x-guest-layout>
    <div class="flex flex-col" style="background-color:#FFFFFF" id="back-main">
        <!-- Menú de preguntas -->
        <div class="d-none d-xl-block flex flex-row bg-[#FFFFFF] space-x-7 py-3 px-5 md:justify-start md:flex-wrap" style="margin-top:-10px">
            <a class="text-[#8B1232] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Inicio</a>
            <a class="text-[#BC955C] hover:text-[#8B1232] no-underline font-bold text-center" href="#virtual-store">¿Qué es Mi Tiendita Virtual?</a>
            <a class="text-[#BC955C] hover:text-[#8B1232] no-underline font-bold text-center" href="#">Preguntas frecuentes</a>
            <a class="text-[#BC955C] hover:text-[#8B1232] no-underline font-bold text-center" href="#">Directorio CDMX</a>
            <a class="text-[#BC955C] hover:text-[#8B1232] no-underline font-bold text-center" href="#">Ya soy proveedor</a>
        </div>
        <div class="d-none d-xl-block w-full h-2 bg-mtv-gold-light"></div>

        <!-- Carousel -->
        <div class="h-96"> 
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{ asset('assets/fakeBanner_01.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>¿Quieres saber cómo venderle a la CDMX</h5>
                            <p>Conoce Mi Tiendita Virtual</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('assets/fakeBanner_02.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Bienvenido a Mi Tiendita Virtual</h5>
                            <p>Conoce Mi Tiendita Virtual</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('assets/fakeBanner_03.png') }}" />
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Bienvenido a Mi Tiendita Virtual</h5>
                            <p>Conoce Mi Tiendita Virtual</p> -->
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previo</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
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
               <p class="message-second">Quiero conocer cómo venderle a la CDMX</p>
               <button onclick="window.location='{{ route('flujograma.show') }}'">Requisitos y documentos</button>
            </div>
            <div class="card-menu-bottom">
               <div class="circle">
               @svg('product', ['class' => 'h-20 w-20 '])
               </div>
               <p class="message-one">Ofrece tu producto</p>
               <p class="message-second">Regístrate y ofrece tus productos</p>
               <button>Crea tu catálogo</button>
            </div>
            <div class="card-menu-bottom">
               <div class="circle">
               @svg('planning', ['class' => 'h-20 w-20 '])
               </div>
               <p class="message-one">Conoce la planeación anual</p>
               <p class="message-second">Compras programadas para el próximo año</p>
               <button>Calendario de compras</button>
            </div>
            <div class="card-menu-bottom">
               <div class="circle">
               @svg('serch', ['class' => 'h-20 w-20 '])
               </div>
               <p class="message-one">Ya soy proveedor</p>
               <p class="message-second">Estoy registrado en padrón de proveedores</p>
               <button>buscador de oportunidades</button>
            </div>
        </div>
<!-- Menú de mi Tiendita virtual-->
        <div class="d-none d-xl-block flex flex-row bg-[#9F2241] space-x-7 py-3 px-5 md:justify-center md:flex-wrap menu-mtv">
            <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#">Inicio</a>
            <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#virtual-store">¿Qué es Mi Tiendita Virtual</a>
            <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#for-virtual-store">¿Para quién es?</a>
            <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#how-part-virtual-store">¿Cómo formo parte?</a>
            <a class="text-[#DDC9A3] hover:text-[#FFFFFF] no-underline font-bold text-center" href="#">¿Tienes dudas?</a>
        </div>
        <div class="d-none d-xl-block w-full h-2 bg-mtv-gold-light menu-mtv-border"></div>

<!-- sección qué es mtv-->
        <div class="what-mtv" id="virtual-store">
            <div class="what-mtv-left ">
                <img src="{{ asset('assets/smartphone_01.png') }}" />
            </div>
            <div class="what-mtv-right">
               <p class="what-mtv-right-title">¿Qué es mi tiendita virtual?</p>
               <p class="what-mtv-mesagge">Es una plataforma diseñada para facilitar la interacción entre empresarios (personas
               físicas o morales) y Unidades Responsables de Gasto o “URG” (Organismos Autónomos,
               Dependencias, Órganos Desconcentrados, Alcaldías y Entidades de la Ciudad de México).<br>
               Esta plataforma tiene tres funcionalidades principales: creación de <b>catálogo de
               productos, calendario anual de compras y buscador de oportunidades</b> para
               participar en procedimientos y venderle al Gobierno de la CDMX*.</p>
               <p class="what-mtv-right-title-second">Promueve tu producto o servicio</p>
               <p class="what-mtv-mesagge">Al registrarte tendrás la <b>opción de crear tu catálogo de productos y/o servicios</b> lo cual
               te brinda la posibilidad de <b>promocionarte</b> con las URG de la CDMX y, al hacer visible tu
               negocio, te podrán <b>invitar a los procedimientos de carácter público</b> (licitaciones,
               invitaciones restringidas y adjudicaciones directas) para la adquisición de aquellos
               bienes o servicios que ofrezcas y requieran.<br>
               Al mismo tiempo, tu catálogo se convertirá en <b>una herramienta de venta</b> la cual
               podrás <b>compartir con tus clientes y prospectos.</b></p>
               <button class=" hover hover:text-[#9f2241] hover:bg-[#ddc9a3]" type="button" onclick="window.location='{{ route('registro-inicio') }}'">Quiero Registrarme @svg('circle-arrow-fill', ['class' => 'd-inline ml-2'])</button>
               <p class="what-mtv-mesagge-note">*Para participar en los procedimientos se requiere constancia vigente en Padrón de Proveedores.</p>
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
                    <img  class="image-responsive" src="{{ asset('assets/img_04.jpg') }}" />
                </div>
            </div>
            <div class="for-mtv-information-container">
                <div class="for-mtv-information-container-top">
                    <p class="for-mtv-information-container-top-title">¿Para quién es Mi Tiendita Virtual?</p>
                    <p class="for-mtv-information-container-top-message"> Es para empresarios o público en general que quieren conocer cómo venderle al Gobierno de la CDMX
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
                            <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Identifica los requisitos y documentos para ser proveedor.</li>
                            <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Descubre si tu producto lo compra la CDMX.</li>
                            <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Crea tu catálogo de productos (sólo requieres contar con tu RFC con homoclave para registrarte).</li>
                        </ul>
                        <div class="divider"></div>
                        <div class="for-mtv-information-button-container">
                            <button class=" hover hover:text-[#600a21] hover:bg-[#ddc9a3]" type="button" onclick="window.location='{{ route('registro-inicio') }}'">Regístrate</button>
                        </div>
                    </div>
                    <div class="for-mtv-information-container-bottom-gold">
                        <p class="for-mtv-information-title-gold">Ya soy proveedor</p>
                        <p class="for-mtv-information-notes">(estoy registrado en Padrón de proveedores)</p>
                        <p class="for-mtv-information-text">No es necesario que te registres. Ingresa con tu usuario de Padrón de Proveedores.<br>En Mi Tiendita Virtual puedes:</p>
                        <ul>
                            <li> @svg('circle-check', ['class' => 'd-inline mr-2'])Crear tu catálogo de productos.</li>
                            <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Conocer qué planea comprar la CDMX el siguiente año.</li>
                            <li> @svg('circle-check', ['class' => 'd-inline mr-2'])Buscar oportunidades de negocio y activar notificaciones.</li>
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
                <p class="how-part-information-text">Sólo tienes que registrar tu empresa y al menos un producto. Además <b>con tu registro</b>
                <b>podrás activar notificaciones sobre convocatorias </b> y temas de tu interés todo para que estés al día sobre lo que compra la CDMX.</p>
                <button class=" hover hover:text-[#9f2241] hover:bg-[#ddc9a3]" type="button" onclick="window.location='{{ route('registro-inicio') }}'">Regístrate aquí</button>
                <p class="how-part-information-title">¿Por qué ser parte de Mi Tiendita Virtual</p>
          </div>
          <div class="why-be-part-of">
              <div class="why-be-part-of-container">
                  @svg('package', ['class' => 'h-20 w-20 '])
                  <p class="why-be-part-of-container-title">Catálogo digital</p>
                  <p class="why-be-part-of-container-text">Tu catálogo de productos ayuda a que el Gobierno de la CDMX conozca 
                  tu negocio y tu oferta comercial.</p>
              </div>
              <div class="why-be-part-of-container">
                  @svg('notification', ['class' => 'h-20 w-20 '])
                  <p class="why-be-part-of-container-title">Notificaciones</p>
                  <p class="why-be-part-of-container-text">Con tu registro podrás activar las
                  notificaciones y recibirás alertas que te
                  permitan conocer qué compra la CDMX.</p>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-bar-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
    </div>
</x-guest-layout>

<script type="text/javascript">
const buttonUp =  document.getElementById("button-back-up")

const arrowBackFunction = () => {
    let currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if(currentScroll > 0) {
            window.scrollTo (0,0);
        }
    }

buttonUp.addEventListener("click",arrowBackFunction)

let screenWidth = +screen.width
const scrollFunction = (min,max) => {
    window.onscroll = function () {
        let scroll = document.body.scrollTop;
        if(scroll < min || scroll > max) {
            buttonUp.style.transform = "scale(0)"
        }else {
            buttonUp.style.transform = "scale(1)";
        }
    }
}
if (screenWidth < 450){
    scrollFunction(700,4700);

} else {
    scrollFunction(500,2700)
}

</script>
