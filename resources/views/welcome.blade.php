<x-guest-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Menú de preguntas -->
        <div class="flex flex-row bg-[#FFFFFF] space-x-7 py-3 px-5 md:justify-start md:flex-wrap border border-5 border-top-0 border-end-0 border-start-0">
            <a class="text-[#8B1232] hover:text-[#BC955C] no-underline font-bold text-center" href="#">Inicio</a>
            <a class="text-[#BC955C] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Qué es Mi Tiendita Virtual?</a>
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
        <div class="flex flex-row bg-[#9F2241] space-x-7 py-3 px-5 md:justify-center md:flex-wrap">
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Qué es Mi Tiendita Virtual</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Para quién es?</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Cómo formo parte?</a>
            <a class="text-[#DDC9A3] hover:text-[#BC955C] no-underline font-bold text-center" href="#">¿Tienes dudas?</a>
        </div>
        <div class="what-mtv" id="virtual-store">
            <div class="what-mtv-left">
            <p>IMAGENES</p>
            </div>
            <div class="what-mtv-right">
               <p>¿Qué es mi tiendita virtual</p>
               <p>Es una plataforma diseñada para facilitar la interacción entre empresarios (personas
               físicas o morales) y Unidades Responsables de Gasto o “URG” (Organismos Autónomos,
               Dependencias, Órganos Desconcentrados, Alcaldías y Entidades de la Ciudad de México).
               Esta plataforma tiene tres funcionalidades principales: creación de catálogo de
               productos, calendario anual de compras y buscador de oportunidades para
               participar en procedimientos y venderle al Gobierno de la CDMX*.</p>
               <p>Promueve tu producto o servicio</p>
               <p>Al registrarte tendrás la opción de crear tu catálogo de productos y/o servicios lo cual
               te brinda la posibilidad de promocionarte con las URG de la CDMX y, al hacer visible tu
               negocio, te podrán invitar a los procedimientos de carácter público (licitaciones,
               invitaciones restringidas y adjudicaciones directas) para la adquisición de aquellos
               bienes o servicios que ofrezcas y requieran.
               Al mismo tiempo, tu catálogo se convertirá en una herramienta de venta la cual
               podrás compartir con tus clientes y prospectos.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
