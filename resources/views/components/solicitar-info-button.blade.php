@props(['proveedor_id' => null])

{{-- <a href="mailto:{{ $producto->proveedor_email }}" 
        class="mtv-button-secondary">
        @svg('ri-mail-send-line', ['class' => 'w-5 h-5 inline-block mr-2'])
        Solicitar información
    </a> --}}

<button 
    x-data="solicitarInfoButton()"
    class="mtv-button-secondary"
    data-bs-toggle="modal"
    data-bs-target="#mensajeModal"
    @if($esUsuarioURG())
    @click="mostrarFormulario(@js($getUsuarioURGDatos()))"
    @else    
    @click="mostrarMensaje()"
    @endif>
        @svg('ri-mail-send-line', ['class' => 'w-5 h-5 inline-block mr-2'])
        Solicitar información
</button>

@if($esUsuarioURG())
<!-- Modal -->
<div class="modal fade" id="mensajeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-mtv-gray-light">
                <h5 class="modal-title" id="mensajeModalLabel"></h5>
                <button type="button" class="btn-close" @click="editFormClose()" aria-label="Close"></button>
            </div>
            <div id="mensajeFormContainer" class="modal-body">
                {{-- <x-productos.cabms-categorias-select />
                <x-productos.producto-fotos-upload /> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="mtv-button-secondary" @click="guardaProducto(productoEditado)">Enviar</button>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script type="text/javascript">
    function solicitarInfoButton() {
        return {            
            mostrarFormulario(usuarioURG) {
                console.log(usuarioURG);
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
                    }
                });
            }
        }
    }
</script>
@endpush