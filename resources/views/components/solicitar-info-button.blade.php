@props(['proveedor' => null, 'producto' => null])

@isset($producto)
    @php
        $proveedor_email = $producto->proveedor_email;
        $proveedor_nombre = $producto->nombre_negocio;
        $producto_nombre = $producto->nombre;
    @endphp
@endisset

@isset($proveedor)
    @php
        $proveedor_email = $proveedor->email;
        $proveedor_nombre = $proveedor->perfil_negocio->nombre_negocio;        
    @endphp
@endisset

<div x-data="solicitarInfoButton()">
    <button class="mtv-button-secondary mb-0"
        @if($esUsuarioURG())
        @click="mostrarFormulario()"
        @else    
        @click="mostrarMensaje()"
        @endif>
        @svg('ri-mail-send-line', ['class' => 'w-5 h-5 inline-block mr-2'])
        Solicitar información
    </button>

    @if($esUsuarioURG())
    <!-- Modal -->
    <div class="modal fade" id="mensajeModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-mtv-gray-light">
                    <h5 class="modal-title" id="mensajeModalLabel"></h5>
                    <button type="button" class="btn-close" @click="cerrarFormulario()" aria-label="Close"></button>
                </div>
                <div id="mensajeFormContainer" class="modal-body">
                    <div class="w-1/2">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="email_proveedor" 
                                   value="{{ $proveedor_email }}" disabled>
                            <label class="mtv-input-label" for="email_proveedor">Correo electrónico Proveedor</label>
                        </div>
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="email_urg" 
                                   value="{{ $usuarioURG['email'] }}" disabled>
                            <label class="mtv-input-label" for="email_urg">Correo electrónico URG</label>
                        </div>
                        <div class="mtv-input-wrapper">
                            <select type="text" class="mtv-text-input" id="asunto">
                                <option value="1">Más información</option>
                                <option value="2">Solicitar cotización</option>
                            </select>
                            <label class="mtv-input-label" for="asunto">Asunto</label>
                        </div>
                    </div>                                        
                    <p class="text-mtv-text-gray my-3">
                        Estimado proveedor <strong>{{ $proveedor_nombre }}</strong>, 
                        nos encontramos interesados en conocer más información sobre su producto
                        <strong>{{ isset($producto_nombre) ? ' ' . $producto_nombre : '' }}.</strong>
                    </p>
                    <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="mensaje" placeholder="Escriba aquí el mensaje"></textarea>
                        <label class="mtv-input-label" for="mensaje"></label>
                    </div>
                    <p class="text-mtv-text-gray my-2">Esperamos contar con su pronta respuesta.</p>
                    <p class="text-mtv-text-gray my-2">Atentamente, {{ $usuarioURG['nombre'] }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mtv-button-gold" @click="guardaProducto(productoEditado)">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script type="text/javascript">
    function solicitarInfoButton() {
        return {            
            mensajeModalForm: new bootstrap.Modal(document.getElementById('mensajeModal'), { keyboard: true }),
            mostrarFormulario() {
                this.mensajeModalForm.show();                
            },
            cerrarFormulario() {                
                this.mensajeModalForm.hide();
            },
            mostrarMensaje() {
                const props = SwalMTVCustom;
                props.customClass['title'] = 'swal2-mtv-title';        
                Swal.fire({
                    ...SwalMTVCustom,
                    title: 'Solicitud de información',
                    html: "Por el momento sólo las instituciones compradoras pueden solicitar más información." +
                        '<p class="swal-mtv-html-container-action">¿Quieres ingresar al sistema y enviar un mensaje?</p>',
                    confirmButtonText: 'Ingresar',
                    showCancelButton: false,
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        //window.location.href = rutaLogin;
                        // TODO Login y redirect
                    }
                });
            }
        }
    }
</script>
@endpush