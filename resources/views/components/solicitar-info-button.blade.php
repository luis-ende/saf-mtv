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
                    <form id="mensajeForm" method="POST" action="{{ route('urg-mensajes.send') }}">
                        @csrf
                        <div class="w-1/2">
                            <input type="hidden" name="user_from" value="{{ $usuarioURG['id'] }}">
                            <input type="hidden" name="user_to" value="{{ $proveedor_id }}">
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input bg-slate-50" id="email_proveedor"
                                       value="{{ $proveedor_email }}" readonly>
                                <label class="mtv-input-label" for="email_proveedor">Correo electrónico Proveedor</label>
                            </div>
                            <div class="mtv-input-wrapper">
                                <input type="text" class="mtv-text-input bg-slate-50" id="email_urg"
                                       value="{{ $usuarioURG['email'] }}" readonly>
                                <label class="mtv-input-label" for="email_urg">Correo electrónico URG</label>
                            </div>
                            <div class="mtv-input-wrapper">
                                <select type="text" class="mtv-text-input" id="asunto" name="asunto" required>
                                    <option value="1">Más información</option>
                                    <option value="2">Solicitar cotización</option>
                                </select>
                                <label class="mtv-input-label" for="asunto">Asunto</label>
                            </div>
                        </div>
                        <p class="text-mtv-text-gray my-3 text-left">
                            Estimado proveedor <strong>{{ $proveedor_nombre }}</strong>,
                            nos encontramos interesados en conocer más información sobre
                            @isset($producto_nombre)
                                el producto: <strong>{{ $producto_nombre }}</strong>.
                            @else
                                sus productos.
                            @endisset
                        </p>
                        <div class="mtv-input-wrapper">
                        <textarea class="mtv-text-input" id="mensaje" name="mensaje"
                                  placeholder="Escriba aquí el mensaje" required></textarea>
                            <label class="mtv-input-label" for="mensaje"></label>
                        </div>
                        <p class="text-mtv-text-gray my-2 text-left">Esperamos contar con su pronta respuesta.</p>
                        <p class="text-mtv-text-gray my-2 text-left">Atentamente, {{ $usuarioURG['nombre'] }}</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="mtv-button-gold"
                            @click.preventDefault="enviarMensaje()">
                        Enviar
                    </button>
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
            },
            enviarMensaje() {
                const mensajeForm = document.getElementById('mensajeForm');
                const formData = new FormData(mensajeForm);
                fetch('{{ route('urg-mensajes.send') }}', {
                    method: "POST",
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    body: formData,
                }).then(response => response.json())
                  .then(json => {
                    if (json.error) {
                        Swal.fire({
                            ...SwalMTVCustom,
                            title: 'Error',
                            html: "Ocurrió un error al enviar el mensaje: " +
                                json.error.mensaje.map((item, index) => item).join(','),
                            showCancelButton: false,
                            confirmButtonText: 'Aceptar',
                        })
                    } else {
                        this.cerrarFormulario();
                    }
                });

                //mensajeForm.submit();
            }
        }
    }
</script>
@endpush