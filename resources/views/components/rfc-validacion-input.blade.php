@props(['value', 'modo' => 'registro', 'disabled' => false, 'tipo_persona' => ''])

@php($url = $modo === 'registro' ? '/api/proveedores/registro/' : '/api/proveedores/login/')
@php($placeholder = $tipo_persona === 'F' ? 'XXXXXXXXXX - XXX' : ($tipo_persona === 'M' ? 'XXXXXXXXX - XXX' : ''))
@php($mask = $tipo_persona === 'F' ? '*************' : ($tipo_persona === 'M' ? '************' : ''))

<div x-data="rfcValidacion()">
    <div class="mtv-input-wrapper relative">
        <x-rfc-input
              x-model="rfcText"
              @blur="verificaRFC()"
              @keyup="rfcInvalido = ''"
              :value="$value"
              :disabled="$disabled"                            
              placeholder="{{ $placeholder }}"
              x-mask="{{ $mask }}"                                          
        />
        <div class="absolute inset-y-0 top-4 right-0 pr-3 flex items-center text-sm leading-5">
            <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        </div>
        <input type="hidden" id="rfc_completo" name="rfc_completo" x-model="rfcCompleto">
    </div>
    <label x-show="mensajeError != '' || rfcInvalido != ''" x-text="obtenerMensajeError()" class="text-xs text-red-600 space-y-1"></label>
</div>

<script type="text/javascript">
    function rfcValidacion() {
        return {
            rfcExisteEnPadronProveedores: false,
            rfcEtapaEnPadronProveedores: '',
            rfcExisteEnMTV: false,
            rfcText: document.getElementById('rfc').value,
            rfcInvalido: '',
            rfcCompleto: '',
            mensajeError: '',
            modoValidacion: {!! json_encode($modo) !!},
            rfcVerificacionUrl: {!! json_encode($url) !!},
            isLoading: false,

            verificaRFC() {
                this.rfcExisteEnPadronProveedores = false;
                this.rfcEtapaEnPadronProveedores = '';
                this.rfcExisteEnMTV = false;
                this.rfcInvalido = '';
                this.mensajeError = '';                
                this.rfcCompleto = this.rfcText;

                if (this.esRFCValido(this.rfcCompleto)) {
                    this.isLoading = true;

                    fetch(this.rfcVerificacionUrl + this.rfcCompleto)
                            .then((res) => res.json())
                            .then((res) => {
                                this.isLoading = false;
                                if (res['error']) {
                                    this.mensajeError = 'Servicio no disponible. No es posible registrar el RFC en Mi Tiendita Virtual.'
                                } else {                                    
                                    this.rfcExisteEnPadronProveedores = res['existe_en_padron_proveedores'];
                                    this.rfcExisteEnMTV = res['existe_en_mtv'];
                                    this.rfcEtapaEnPadronProveedores = res['etapa_en_padron_proveedores'];

                                    if (!res['permitir_registro_login']) {
                                        this.rfcInvalido = res['rfc'];                                        
                                        if (this.rfcExisteEnMTV && this.modoValidacion === 'registro') {    
                                            Swal.fire({
                                                ...SwalMTVCustom,
                                                title: 'Ya estás registrado en Mi Tiendita Virtual',
                                                html: '<div class="">' +
                                                    '<span>Puedes crear tu catálogo de productos y revisar notificaciones al ingresar a Mi Tiendita Virtual.</span>' +
                                                    '<p class="swal-mtv-html-container-action">¿Quieres iniciar sesión?</p>' +
                                                    '</div>',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = '/login';
                                                }
                                            })
                                        }
                                    }
                                }
                            })
                }
            },
            obtenerMensajeError() {
                if (this.mensajeError !== '') {
                    return this.mensajeError;
                } else if (this.rfcInvalido !== '') {
                    if (this.modoValidacion === 'registro') {
                        return 'No es posible registrar el RFC en Mi Tiendita Virtual.';
                    } else if (this.modoValidacion === 'login') {
                        return 'No es posible ingresar con el RFC a Mi Tiendita Virtual.';
                    }
                }
            },
            esRFCValido(rfc) {
                return rfc.length === 12 || rfc.length === 13;
            },            
        }
    }
</script>
