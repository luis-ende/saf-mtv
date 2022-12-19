<x-guest-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Menú de preguntas -->
        <div class="flex flex-row bg-[#FFFFFF] space-x-7 py-3 px-5 md:justify-start md:flex-wrap border border-5 border-top-0 border-end-0 border-start-0">
            <a class="text-[#8B1232] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Inicio</a>
            <a class="text-[#BC955C] hover:text-[#BC955C] no-underline font-bold text-center" href="#virtual-store">¿Qué es Mi Tiendita Virtual?</a>
            <a class="text-[#BC955C] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Preguntas frecuentes</a>
            <a class="text-[#BC955C] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Directorio CDMX</a>
            <a class="text-[#BC955C] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Ya soy proveedor</a>
        </div>

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
                        <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
                             width="800" height="400" xmlns="http://www.w3.org/2000/svg"
                             role="img" aria-label="Placeholder: Second slide"
                             preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">First slide</text>
                        </svg>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bienvenido a Mi Tiendita Virtual</h5>
                            <p>Conoce Mi Tiendita Virtual</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
                             width="800" height="400" xmlns="http://www.w3.org/2000/svg"
                             role="img" aria-label="Placeholder: Second slide"
                             preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
                        </svg>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bienvenido a Mi Tiendita Virtual</h5>
                            <p>Conoce Mi Tiendita Virtual</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100"
                             width="800" height="400" xmlns="http://www.w3.org/2000/svg"
                             role="img" aria-label="Placeholder: Second slide"
                             preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Third slide</text>
                        </svg>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bienvenido a Mi Tiendita Virtual</h5>
                            <p>Conoce Mi Tiendita Virtual</p>
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
               <button>Requisitos y documentos</button>
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
               @svg('calendar', ['class' => 'h-20 w-20 '])
               </div>
               <p class="message-one">Oportunidades para vender</p>
               <p class="message-second">Compras programadas para el próximo año</p>
               <button>Calendario de compras</button>
            </div>
            <div class="card-menu-bottom">
               <div class="circle">
               @svg('oportunities', ['class' => 'h-20 w-20 '])
               </div>
               <p class="message-one">Ya soy proveedor</p>
               <p class="message-second">Estoy registrado en padrón de proveedores</p>
               <button>buscador de oportunidades</button>
            </div>
        </div>
<!-- Menú de mi Tiendita virtual-->
        <div class="flex flex-row bg-[#9F2241] space-x-7 py-3 px-5 md:justify-center md:flex-wrap sticky-top">
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#virtual-store">¿Qué es Mi Tiendita Virtual</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#for-virtual-store">¿Para quién es?</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#how-part-virtual-store">¿Cómo formo parte?</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Tienes dudas?</a>
        </div>

<!-- sección qué es mtv-->
        <div class="what-mtv" id="virtual-store">
            <div class="what-mtv-left">
           
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
               <button>Quiero Registrarme @svg('circle-arrow-fill', ['class' => 'd-inline ml-2'])</button>
               <p class="what-mtv-mesagge-note">*Para participar en los procedimientos se requiere constancia vigente en Padrón de Proveedores.</p>
            </div>
        </div>
<!-- sección para quién es mtv-->
        <div class="for-mtv" id="for-virtual-store">
            <div class="image-container">
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
                      <div class="for-mtv-information-button-container">
                      <button>Regístrate</button>
                      </div>
                      <div class="horizontal-plot-red"></div>
                    </div>
                    <div class="for-mtv-information-container-bottom-gold">
                      <p class="for-mtv-information-title-gold">Ya soy proveedor</p>
                      <p class="for-mtv-information-notes">(estoy registrado en Padrón de proveedores)</p>
                      <p class="for-mtv-information-text">No es necesario que te registres. Ingresa con tu usuario de Padrón de Proveedores.<br>En Mi Tiendita Virtual puedes:</p>
                      <ul>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Crear tu catálogo de productos.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Conocer qué planea comprar la CDMX el siguiente año.</li>
                        <li>@svg('circle-check', ['class' => 'd-inline mr-2'])Buscar oportunidades de negocio y activar notificaciones.</li>
                      </ul>
                      <div class="for-mtv-information-button-container">
                      <button>Ingresa</button>
                      </div>
                      <div class="horizontal-plot-gold"></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- sección para cómo formo parte de MTV-->
        <div class="how-part" id="how-part-virtual-store">
          @svg('horizontal-plot')
          <div class="how-part-information">
              <p class="how-part-information-title">¿Cómo formo parte de Mi Tiendita Virtual?</p>
              <p class="how-part-information-text">Sólo tienes que registrar tu empresa y al menos un producto. Además <b>con tu registro</b>
              <b>podrás activar notificaciones sobre convocatorias </b> y temas de tu interés todo para que estés al día sobre lo que compra la CDMX.</p>
              <button>Regístrate aquí</button>
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
    </div>
</x-guest-layout>
