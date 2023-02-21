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
        <p class="information-container-subtitle">Si te has preguntado cómo venderle al Gobierno, qué requisitos y documentos debes reunir,
        continúa leyendo.</p>
        <p class="information-container-message">El Gobierno de la Ciudad de México adquiere a través de cada una de sus <a href="#" class="text-[#BC955C] hover:text-[#8B1232]">Instituciones compradoras</a>, una amplia variedad de bienes y servicios año con año, lo cual brinda la oportunidad a personas
        físicas y morales de convertirse en proveedores del Gobierno. Venderle a la CDMX representa grandes
        beneficios para tu negocio, por eso en MI TIENDITA VIRTUAL buscamos apoyarte para incrementar tu cartera
        de clientes a nivel gobierno y te damos las herramientas para iniciar esta meta.</p>
        <div class="back-home">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            <a href="{{ route('homepage') }}"> Página de inicio</a>
        </div>
        <p class="icon-message">Da clic en los iconos para desplegar la información</p>
    </div>

        <div class="buttons-container" >
            <div class="button-container">
                <button  id="button-register">
                    @svg('register', ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point-df'])
                    Regístrate en Mi Tiendita Virtual
                </button>
            </div>
            <div class="button-container">
                <button  id="button-oportunities">
                    @svg('search', ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Encuentra una Oportunidad de negocio
                </button>
            </div>
            <div class="button-container">
                <button  id="button-process">
                    @svg('provider', ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Tramita tu constancia en el Padrón de Proveedores
                </button>
            </div>
            <div class="button-container">
                <button  id="button-documentation">
                    @svg('document', ['class' => 'h-20 w-20 img-svg'])
                    @svg('point', ['class' => 'point'])
                    Documentos para participar en un procedimiento
                </button>
            </div>
        </div>
        <div class="cares-line"></div>

    <!-- resgistro-->
                    <div class="item-content" id="register">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="icons-content">
                                @svg('lineawesome-user-check-solid', ['class' => 'h-10 w-10 '])
                                <div class="line-divider"></div>
                                @svg('store', ['class' => 'h-10 w-10'])
                            </div>
                            <div class="content-card-items">
                                <div class="card-items">
                                    <p class="title">Regístrate en Mi Tiendita Virtual</p>
                                    <p class="message">Esta plataforma te permite tener <strong>acceso a la información de Contrataciones Públicas de la CDMX</strong> y, de acuerdo a tu perfil, se te <strong>sugerirán oportunidades de negocio</strong>. Para registrarte sólo requieres RFC con homoclave 
                                        y un correo electrónico, así como los datos generales de tu negocio.</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="mr-3">Regístrate aquí</a>
                                        <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-items">
                                    <p class="title">Promueve tus productos</p>
                                    <p class="message">Al registrarte podrás <strong>crear tu Tiendita Virtual</strong> y así las Instituciones compradoras podrán conocer tus productos y contactarte. 
                                        Además, puedes compartir el enlace con tus clientes y prospectos.</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="mr-3">Crea tu Tiendita Virtual</a>
                                        <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Encuentra una oportunidad -->

        <div class="item-content" id="oportunities">
            <div class="d-flex justify-content-center align-items-center">
                <div class="icons-content">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                    <path d="M15 6C15 6.55228 14.5523 7 14 7C13.4477 7 13 6.55228 13 6C13 5.44772 13.4477 5 14 5C14.5523 5 15 5.44772 15 6ZM9.7037 2.58399C10.0818 2.20681 10.5951 1.99654 11.1292 2.00004L16.0196 2.0321C17.1179 2.0393 18.0049 2.93081 18.0065 4.02911L18.0138 8.97917C18.0146 9.51063 17.8038 10.0205 17.428 10.3963L17.0675 10.7568C16.8634 10.4918 16.6305 10.2502 16.3734 10.0367L16.7209 9.68923C16.9088 9.50133 17.0142 9.24637 17.0138 8.98065L17.0065 4.03058C17.0057 3.48143 16.5622 3.03568 16.013 3.03208L11.1227 3.00002C10.8556 2.99827 10.599 3.1034 10.4099 3.29199L3.72836 9.95653C3.33699 10.3469 3.33659 10.9808 3.72746 11.3716L8.67586 16.32C9.04849 16.6927 9.64203 16.7097 10.0349 16.3713C10.2487 16.629 10.4907 16.8625 10.7562 17.067C9.97244 17.808 8.73628 17.7947 7.96875 17.0271L3.02036 12.0788C2.2386 11.297 2.23941 10.0293 3.02216 9.24852L9.7037 2.58399ZM16.3032 15.5961C16.7408 15.0118 17 14.2862 17 13.5C17 11.567 15.433 10 13.5 10C11.567 10 10 11.567 10 13.5C10 15.433 11.567 17 13.5 17C14.2862 17 15.0118 16.7408 15.5961 16.3032L18.1464 18.8536C18.3417 19.0489 18.6583 19.0489 18.8535 18.8536C19.0488 18.6584 19.0488 18.3418 18.8536 18.1465L16.3032 15.5961ZM16 13.5C16 14.8807 14.8807 16 13.5 16C12.1193 16 11 14.8807 11 13.5C11 12.1193 12.1193 11 13.5 11C14.8807 11 16 12.1193 16 13.5Z" fill="currentColor"></path></svg>
                    <div class="line-divider"></div>
                    <svg class="w-11 h-11" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"></path>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
</svg>
                </div>
                <div class="content-card-items">
                    <div class="card-items">
                        <p class="title">Busca tu bien o servicio</p>
                        <p class="message">Ingresa a “Mi Tiendita Virtual” y <strong>conoce todas las oportunidades de negocio</strong> que ofrece el Gobierno de la Ciudad de México <strong>con base en los bienes o servicios que ofrece tu negocio</strong>. Consulta las características del procedimiento 
                            de tu interés (fechas, tipo de procedimiento, bases, entre otros).</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Oportunidades de negocio</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-items">
                        <p class="title">Guarda las oportunidades de negocio de tu interés</p>
                        <p class="message">Al registrarte recibirás notificaciones de nuevas oportunidades <strong>de acuerdo a tu Perfil 
                            y tu Tiendita Virtual,</strong> además podrás guardar las que sean de tu interés.</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Favoritos</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Tramita tu constancia -->
                    <div class="item-content" id="process">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="icons-content">
                                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 1.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v7.736a.75.75 0 101.5 0V1.75A1.75 1.75 0 0011.25 
                                    0h-8.5A1.75 1.75 0 001 1.75v11.5c0 .966.784 1.75 1.75 1.75h3.17a.75.75 0 000-1.5H2.75a.25.25 0 01-.25-.25V1.75zM4.75 4a.75.75 0 
                                    000 1.5h4.5a.75.75 0 000-1.5h-4.5zM4 7.75A.75.75 0 014.75 7h2a.75.75 0 010 1.5h-2A.75.75 0 014 7.75zm11.774 3.537a.75.75 0 
                                    00-1.048-1.074L10.7 14.145 9.281 12.72a.75.75 0 00-1.062 1.058l1.943 1.95a.75.75 0 001.055.008l4.557-4.45z"></path></svg>  
                                </div>
                                <div class="content-card-items">
                                    <div class="card-items">
                                        <p class="title">Regístrate en Padrón de Proveedores</p>
                                        <p class="message">Si encontraste alguna oportunidad de negocio y algún procedimiento es de tu
                                    interés, tramita tu <a href="#" class="text-[#BC955C] hover:text-[#8B1232] text-decoration-underline">Constancia de Registro en el Padrón de Proveedores</a> de la
                                    Administración Pública de la Ciudad de México.</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Tramita tu constancia</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="admin-title">Documentación requerida para tramitar la constancia en el padrón de proveedores</p>
                            <div>
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

<!-- Sección Documentación para participar en el proceso  -->

                    <div class="item-content" id="documentation">
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="icons-content">
                                    <svg class="w-11 h-11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                                        <path d="M8 11C8 11.5523 7.55228 12 7 12C6.44772 12 6 11.5523 6 11C6 10.4477 6.44772 10 7 10C7.55228 10 8 10.4477 8 11ZM8 14C8 14.5523 7.55228 15 
                                        7 15C6.44772 15 6 14.5523 6 14C6 13.4477 6.44772 13 7 13C7.55228 13 8 13.4477 8 14ZM13 12C13.5523 12 14 11.5523 14 11C14 10.4477 13.5523 10 13 10C12.4477 
                                        10 12 10.4477 12 11C12 11.5523 12.4477 12 13 12ZM14 14C14 14.5523 13.5523 15 13 15C12.4477 15 12 14.5523 12 14C12 13.4477 12.4477 13 13 13C13.5523 13 14 
                                        13.4477 14 14ZM10 12C10.5523 12 11 11.5523 11 11C11 10.4477 10.5523 10 10 10C9.44772 10 9 10.4477 9 11C9 11.5523 9.44772 12 10 12ZM11 14C11 14.5523 10.5523 
                                        15 10 15C9.44772 15 9 14.5523 9 14C9 13.4477 9.44772 13 10 13C10.5523 13 11 13.4477 11 14ZM7.5 4C6.67157 4 6 4.67157 6 5.5V6.5C6 7.32843 6.67157 8 7.5 
                                        8H12.5C13.3284 8 14 7.32843 14 6.5V5.5C14 4.67157 13.3284 4 12.5 4H7.5ZM7 5.5C7 5.22386 7.22386 5 7.5 5H12.5C12.7761 5 13 5.22386 13 5.5V6.5C13 6.77614 12.7761 
                                        7 12.5 7H7.5C7.22386 7 7 6.77614 7 6.5V5.5ZM16 15.5C16 16.8807 14.8807 18 13.5 18H6.5C5.11929 18 4 16.8807 4 15.5V4.5C4 3.11929 5.11929 2 6.5 2H13.5C14.8807 2 
                                        16 3.11929 16 4.5V15.5ZM15 4.5C15 3.67157 14.3284 3 13.5 3H6.5C5.67157 3 5 3.67157 5 4.5V15.5C5 16.3284 5.67157 17 6.5 17H13.5C14.3284 17 15 16.3284 15 15.5V4.5Z" 
                                        fill="currentColor"></path>
                                    </svg>
                                    <div class="line-divider"></div>
                                    <svg class="w-11 h-11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><defs></defs><path d="M25.707,17.293l-5-5A1,1,0,0,0,20,12H14a2,2,0,0,0-2,2V28a2,2,0,0,0,2,2H24a2,2,0,0,0,2-2V18A1,1,0,0,0,25.707,17.293ZM23.5857,18H20V14.4141ZM14,28V14h4v4a2,2,0,0,0,2,2h4v8Z"></path><path d="M8,27H4a2.0023,2.0023,0,0,1-2-2V5A2.0023,2.0023,0,0,1,4,3h7.5857A1.9865,1.9865,0,0,1,13,3.5859L16.4143,7H28a2.0023,2.0023,0,0,1,2,2v8H28V9H15.5857l-4-4H4V25H8Z"></path><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill: none"></rect></svg>
                                </div>

                                <div class="content-card-items">
                                    <div class="card-items">
                                        <p class="title">Cotiza tu Bien o Servicio</p>
                                        <p class="message">Al tener tu constancia de Padrón de Proveedores vigente y dependiendo el tipo
                                        de procedimiento, puedes cotizar el bien o servicio que la Istitución compradora desee adquirir.
                                        <strong>Cotiza por medio del sistema de requisiciones del Gobierno de la CDMX.</strong></p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Ir al sistema de Requisiciones</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="card-items">
                                        <p class="title">Conoce las bases del procedimiento</p>
                                        <p class="message">En caso de resultar participante, con base en las características del
                                        procedimiento estipuladas por la Institución compradora, sigue el proceso correspondiente.</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Directorio de Instituciones compradoras</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="title-doc-request">Documentación requerida para participar en un procedimientos </p>
                            <div class="d-flex justify-content-evenly content-crd">
                                <div class="documents-card">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header admin-title" id="flush-headingOne">
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            ADMINISTRATIVA Y LEGAL
                                            <svg class="w-6 h-6" fill="currentColor" style="margin-left:10px" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
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
                                                <p class="admin-subtitle">Documentación requerida por la Institución compradora</p>
                                                <ul>
                                                    <li class="bullets">Manifiestos relacionados</li>
                                                    <li class="bullets">Otros (consultar con la Institución compradora solicitante)</li>
                                                </ul>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="mr-3">Directorio CDMX</a>
                                                        <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
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
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            TÉCNICA
                                            <svg class="w-6 h-6" fill="currentColor" style="margin-left:55%" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            ECONÓMICA
                                            <svg class="w-6 h-6" fill="currentColor" style="margin-left:45%" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body border-0">
                                                <p class="admin-subtitle">Documentación por parte del proveedor</p>
                                                <ul>
                                                    <li>Propuesta económica (cotización)</li>
                                                </ul>
                                                <div class="line-dot-divider"></div>
                                                <p class="admin-subtitle">Documentación por parte de la Institución compradora</p>
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
<!-- mobile -->

<div class="acordion-mobile">
    <div class="accordion-item">
        <div class="accordion-header" id="flush-headingOne">
            <div class="button-container">
                <button type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    @svg('register',['class' => ' h-20 w-20 svg-mobile'])
                    Regístrate en Mi Tiendita Virtual
                </button>
            </div>
        </div>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body ">
            <div class="item-content-mobile ">
            <div class="d-flex justify-content-center align-items-center content-mobile">
                <div class="icons-content">
                    @svg('lineawesome-user-check-solid', ['class' => 'h-8 w-8 '])
                    <div class="line-divider"></div>
                    @svg('store', ['class' => 'h-8 w-8'])
                </div>
                <div class="content-card-items mt-10">
                    <div class="card-items">
                        <p class="title">Regístrate en “Mi Tiendita Virtual”</p>
                        <p class="message">Esta plataforma te permite tener acceso a la información de Contrataciones Públicas de la CDMX y, de acuerdo a tu perfil, se te sugerirán oportunidades de negocio. Para registrarte sólo requieres RFC con 
                            homoclave y un correo electrónico, así como los datos generales de tu negocio.</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Regístrate aquí</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-items">
                        <p class="title">Promueve tus productos </p>
                        <p class="message">Al registrarte podrás crear tu Tiendita Virtual y así las Instituciones compradoras podrán conocer tus productos y contactarte. Además, puedes compartir el enlace con tus clientes y prospectos.</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Crea tu Tiendita virtual</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
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
                    <button  type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    @svg('search', ['class' => 'h-20 w-20 svg-mobile'])
                    Encuentra una Oportunidad de negocio
                    </button>
                </div>
            </div>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                <div class="item-content-mobile">
            <div class="d-flex justify-content-center align-items-center content-mobile">
                <div class="icons-content">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                    <path d="M15 6C15 6.55228 14.5523 7 14 7C13.4477 7 13 6.55228 13 6C13 5.44772 13.4477 5 14 5C14.5523 5 15 5.44772 15 6ZM9.7037 2.58399C10.0818 2.20681 10.5951 1.99654 11.1292 2.00004L16.0196 2.0321C17.1179 2.0393 18.0049 2.93081 18.0065 4.02911L18.0138 8.97917C18.0146 9.51063 17.8038 10.0205 17.428 10.3963L17.0675 10.7568C16.8634 10.4918 16.6305 10.2502 16.3734 10.0367L16.7209 9.68923C16.9088 9.50133 17.0142 9.24637 17.0138 8.98065L17.0065 4.03058C17.0057 3.48143 16.5622 3.03568 16.013 3.03208L11.1227 3.00002C10.8556 2.99827 10.599 3.1034 10.4099 3.29199L3.72836 9.95653C3.33699 10.3469 3.33659 10.9808 3.72746 11.3716L8.67586 16.32C9.04849 16.6927 9.64203 16.7097 10.0349 16.3713C10.2487 16.629 10.4907 16.8625 10.7562 17.067C9.97244 17.808 8.73628 17.7947 7.96875 17.0271L3.02036 12.0788C2.2386 11.297 2.23941 10.0293 3.02216 9.24852L9.7037 2.58399ZM16.3032 15.5961C16.7408 15.0118 17 14.2862 17 13.5C17 11.567 15.433 10 13.5 10C11.567 10 10 11.567 10 13.5C10 15.433 11.567 17 13.5 17C14.2862 17 15.0118 16.7408 15.5961 16.3032L18.1464 18.8536C18.3417 19.0489 18.6583 19.0489 18.8535 18.8536C19.0488 18.6584 19.0488 18.3418 18.8536 18.1465L16.3032 15.5961ZM16 13.5C16 14.8807 14.8807 16 13.5 16C12.1193 16 11 14.8807 11 13.5C11 12.1193 12.1193 11 13.5 11C14.8807 11 16 12.1193 16 13.5Z" fill="currentColor"></path></svg>
                    <div class="line-divider"></div>
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"></path>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
</svg>
                </div>
                <div class="content-card-items mt-10">
                    <div class="card-items">
                        <p class="title">Busca tu bien o servicio</p>
                        <p class="message">Ingresa a “Mi Tiendita Virtual” y conoce todas las oportunidades de negocio que ofrece el Gobierno de la Ciudad de México con base en los bienes o servicios que ofrece tu negocio. Consulta las características 
                            del procedimiento de tu interés (fechas, tipo de procedimiento, bases, entre otros).</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Oportunidades de negocio</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-items">
                        <p class="title">Guarda las oportunidades de negocio de tu interés</p>
                        <p class="message">Al registrarte recibirás notificaciones de nuevas oportunidades de acuerdo a tu Perfil y tu Tiendita Virtual, además podrás guardar las que sean de tu interés.</p>
                        <div class="d-flex align-items-center">
                            <a href="#" class="mr-3">Favoritos</a>
                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                            </svg>
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
                    <button  type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        @svg('provider', ['class' => 'h-20 w-20 svg-mobile'])
                        Tramita tu constancia en el Padrón de Proveedores
                    </button>
                </div>
            </div>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-center align-items-center content-mobile">
                            <div class="icons-content">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 1.75a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v7.736a.75.75 0 101.5 0V1.75A1.75 1.75 0 0011.25 
                                0h-8.5A1.75 1.75 0 001 1.75v11.5c0 .966.784 1.75 1.75 1.75h3.17a.75.75 0 000-1.5H2.75a.25.25 0 01-.25-.25V1.75zM4.75 4a.75.75 0 
                                000 1.5h4.5a.75.75 0 000-1.5h-4.5zM4 7.75A.75.75 0 014.75 7h2a.75.75 0 010 1.5h-2A.75.75 0 014 7.75zm11.774 3.537a.75.75 0 
                                00-1.048-1.074L10.7 14.145 9.281 12.72a.75.75 0 00-1.062 1.058l1.943 1.95a.75.75 0 001.055.008l4.557-4.45z"></path></svg>  
                            </div>
                            <div class="content-card-items mt-10">
                                <div class="card-items">
                                    <p class="title">Regístrate en Padrón de Proveedores</p>
                                    <p class="message">Si encontraste alguna oportunidad de negocio y algún procedimiento es de tu
                                interés, tramita tu <a href="#" class="text-[#BC955C] hover:text-[#8B1232]">Constancia de Registro en el Padrón de Proveedores</a> de la
                                Administración Pública de la Ciudad de México.</p>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="mr-3">Tramita tu constancia</a>
                                        <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                        </svg>
                                    </div>
                               </div>
                            </div>
                        </div>
                        <p class="admin-title"> Documentación Requerida para tramitar la constancia en el padrón de proveedores </p>
                        <div class="accordion-item">
    <h2  id="flush-headingOne">
      <button class="tittle-table hover:text-[##691c20] " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Mostrar documentos 
        
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div >
      <div class="p-3">
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
                    
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header" id="flush-headingFour">
                <div class="button-container">
                <button  type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    @svg('document', ['class' => 'h-20 w-20 svg-mobile'])
                    Encuentra una Oportunidad de Compra
                </button>
                </div>
            </div>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                <div class="item-content-mobile">
                        <div>
                            <div class="d-flex justify-content-center align-items-center content-mobile">
                                <div class="icons-content">
                                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                                        <path d="M8 11C8 11.5523 7.55228 12 7 12C6.44772 12 6 11.5523 6 11C6 10.4477 6.44772 10 7 10C7.55228 10 8 10.4477 8 11ZM8 14C8 14.5523 7.55228 15 
                                        7 15C6.44772 15 6 14.5523 6 14C6 13.4477 6.44772 13 7 13C7.55228 13 8 13.4477 8 14ZM13 12C13.5523 12 14 11.5523 14 11C14 10.4477 13.5523 10 13 10C12.4477 
                                        10 12 10.4477 12 11C12 11.5523 12.4477 12 13 12ZM14 14C14 14.5523 13.5523 15 13 15C12.4477 15 12 14.5523 12 14C12 13.4477 12.4477 13 13 13C13.5523 13 14 
                                        13.4477 14 14ZM10 12C10.5523 12 11 11.5523 11 11C11 10.4477 10.5523 10 10 10C9.44772 10 9 10.4477 9 11C9 11.5523 9.44772 12 10 12ZM11 14C11 14.5523 10.5523 
                                        15 10 15C9.44772 15 9 14.5523 9 14C9 13.4477 9.44772 13 10 13C10.5523 13 11 13.4477 11 14ZM7.5 4C6.67157 4 6 4.67157 6 5.5V6.5C6 7.32843 6.67157 8 7.5 
                                        8H12.5C13.3284 8 14 7.32843 14 6.5V5.5C14 4.67157 13.3284 4 12.5 4H7.5ZM7 5.5C7 5.22386 7.22386 5 7.5 5H12.5C12.7761 5 13 5.22386 13 5.5V6.5C13 6.77614 12.7761 
                                        7 12.5 7H7.5C7.22386 7 7 6.77614 7 6.5V5.5ZM16 15.5C16 16.8807 14.8807 18 13.5 18H6.5C5.11929 18 4 16.8807 4 15.5V4.5C4 3.11929 5.11929 2 6.5 2H13.5C14.8807 2 
                                        16 3.11929 16 4.5V15.5ZM15 4.5C15 3.67157 14.3284 3 13.5 3H6.5C5.67157 3 5 3.67157 5 4.5V15.5C5 16.3284 5.67157 17 6.5 17H13.5C14.3284 17 15 16.3284 15 15.5V4.5Z" 
                                        fill="currentColor"></path>
                                    </svg>
                                    <div class="line-divider"></div>
                                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><defs></defs><path d="M25.707,17.293l-5-5A1,1,0,0,0,20,12H14a2,2,0,0,0-2,2V28a2,2,0,0,0,2,2H24a2,2,0,0,0,2-2V18A1,1,0,0,0,25.707,17.293ZM23.5857,18H20V14.4141ZM14,28V14h4v4a2,2,0,0,0,2,2h4v8Z"></path><path d="M8,27H4a2.0023,2.0023,0,0,1-2-2V5A2.0023,2.0023,0,0,1,4,3h7.5857A1.9865,1.9865,0,0,1,13,3.5859L16.4143,7H28a2.0023,2.0023,0,0,1,2,2v8H28V9H15.5857l-4-4H4V25H8Z"></path><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill: none"></rect></svg>
                                </div>

                                <div class="content-card-items mt-10">
                                    <div class="card-items">
                                        <p class="title">Cotiza tu Bien o Servicio</p>
                                        <p class="message">Al tener tu constancia de Padrón de Proveedores vigente y dependiendo el tipo
                                        de procedimiento, puedes cotizar el bien o servicio que la Istitución compradora desee adquirir.
                                        <strong>Cotiza por medio del sistema de requisiciones del Gobierno de la CDMX.</strong></p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Ir al sistema de Requisiciones</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="card-items">
                                        <p class="title">Conoce las bases del procedimiento</p>
                                        <p class="message">En caso de resultar participante, con base en las características del
                                        procedimiento estipuladas por la Institución compradora, sigue el proceso correspondiente.</p>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="mr-3">Directorio de Instituciones compradoras</a>
                                            <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="title-doc-request">Documentación requerida para participar en un procedimientos </p>
                            <div class="d-flex justify-content-evenly content-crd">
                                <div class="documents-card">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header admin-title" id="flush-headingOne">
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            ADMINISTRATIVA Y LEGAL
                                            <svg class="w-6 h-6" style="margin-left:10%" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
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
                                                    <li class="bullets">Constancia en el padrón de proveedores</li>
                                                    <li class="bullets">Alta de cuenta de cheques</li>
                                                </ul>
                                                <div class="line-dot-divider"></div>
                                                <p class="admin-subtitle">Documentación requerida por la Institución compradora</p>
                                                <ul>
                                                    <li class="bullets">Manifiestos relacionados</li>
                                                    <li class="bullets">Otros (consultar con la Institución compradora solicitante)</li>
                                                </ul>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="mr-3">Directorio CDMX</a>
                                                        <svg class="w-5 h-16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bc955c" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                                        </svg>
                                                </div>
                                                <div class="line-dot-divider"></div>
                                                <p class="bullets"><strong>NOTA:</strong>La Constancia de Registro en el Padrón de
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
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            TÉCNICA
                                            <svg class="w-6 h-6" fill="currentColor" style="margin-left:60%" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                            <button class="accordion-button collapsed hover:text-[#BC955C]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            ECONÓMICA
                                            <svg class="w-6 h-6" fill="currentColor" style="margin-left:50%" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12zm10-4a1 1 0 011 1v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2V9a1 1 0 011-1z"></path></svg>
                                            </button>
                                        </h2>
                                        <div class="doc-divider"></div>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body border-0">
                                                <p class="admin-subtitle">Documentación por parte del proveedor</p>
                                                <ul>
                                                    <li>Propuesta económica (cotización)</li>
                                                </ul>
                                                <div class="line-dot-divider"></div>
                                                <p class="admin-subtitle">Documentación por parte de la Institución compradora</p>
                                                <ul>
                                                    <li>Manifiestos relacionados que requiera</li>
                                                    <li>Otros</li>
                                                </ul>
                                                <div class="line-dot-divider"></div>
                                                <p class="bullets"><strong>NOTA:</strong>La documentación y características
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
        </div>
    </div>
</div>
</x-guest-layout>

<script type="text/javascript">
const buttonRegister = document.getElementById("button-register");
const buttonOportunities = document.getElementById("button-oportunities");
const buttonProcess = document.getElementById("button-process");
const buttonDocumentation = document.getElementById("button-documentation");

const buttonsChange = (id) => {
    let buttonName = document.getElementById(id)
    if(buttonName.style.display === 'none'){
        buttonName.style.display = 'block';
    }else {
        buttonName.style.display = 'none'
    }
}

buttonRegister.addEventListener("click", () => buttonsChange('register'));
buttonOportunities.addEventListener("click", () => buttonsChange('oportunities'));
buttonProcess.addEventListener("click", () => buttonsChange('process'));
buttonDocumentation.addEventListener("click", () => buttonsChange('documentation'));
</script>