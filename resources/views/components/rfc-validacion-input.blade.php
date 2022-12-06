@props(['value', 'modo' => 'registro', 'disabled' => false])

@php($url = $modo === 'registro' ? '/api/proveedores/registro/' : '/api/proveedores/login/')

<div x-data="rfcValidacion()" x-init="rfcCompleto = obtieneRFCCompleto()" class="mtv-input-wrapper">
    <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
    <x-rfc-input
          x-model="rfcText"
          @blur="verificaRFC()"
          @keyup="rfcInvalido = ''"
          :value="$value"
          :disabled="$disabled"
    />
    <label x-show="mensajeError != '' || rfcInvalido != ''" x-text="obtenerMensajeError()" class="text-sm text-red-600 space-y-1"></label>
    <input type="hidden" id="rfc_completo" name="rfc_completo" x-model="rfcCompleto">
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
                let btnFormSubmit = this.modoValidacion === 'registro' ?
                    document.getElementById('btn_perfil_negocio_siguiente') :
                    document.getElementById('btn_login');

                this.rfcExisteEnPadronProveedores = false;
                this.rfcEtapaEnPadronProveedores = '';
                this.rfcExisteEnMTV = false;
                this.rfcInvalido = '';
                this.mensajeError = '';
                if (btnFormSubmit) {
                    btnFormSubmit.disabled = false;
                }

                this.rfcCompleto = this.obtieneRFCCompleto();

                if (this.rfcText && this.rfcCompleto !== '') {
                    this.isLoading = true;

                    fetch(this.rfcVerificacionUrl + this.rfcCompleto)
                            .then((res) => res.json())
                            .then((res) => {
                                this.isLoading = false;
                                if (res['error']) {
                                    this.mensajeError = 'Servicio no disponible. No es posible registrar el RFC en Mi Tiendita Virtual.'
                                    if (btnFormSubmit) {
                                        btnFormSubmit.disabled = true;
                                    }
                                } else {
                                    this.rfcExisteEnPadronProveedores = res['existe_en_padron_proveedores'];
                                    this.rfcExisteEnMTV = res['existe_en_mtv'];
                                    this.rfcEtapaEnPadronProveedores = res['etapa_en_padron_proveedores'];

                                    if (!res['permitir_registro_login']) {
                                        this.rfcInvalido = res['rfc'];

                                        if (this.rfcExisteEnPadronProveedores) {
                                            Swal.fire({
                                                title: this.rfcInvalido,
                                                confirmButtonColor: '#691C32',
                                                html: "Ya cuentas con un registro en el Padrón de Proveedores ("
                                                    + this.rfcEtapaEnPadronProveedores + "). " +
                                                    "Puedes enviar la información de tu catálogo en el perfil de tu negocio. " +
                                                    '<a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">Padrón de Proveedores</a>.',
                                                icon: "warning",
                                                allowOutsideClick: false,
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    if (btnFormSubmit) {
                                                        btnFormSubmit.disabled = true;
                                                    }
                                                }
                                            })
                                        } else if (this.rfcExisteEnMTV && this.modoValidacion === 'registro') {
                                            Swal.fire({
                                                title: this.rfcInvalido,
                                                html: 'Ya cuentas con un registro en Mi Tiendita Virtual. <br><a href="{{ route('login') }}">Inicia sesión</a> para acceder al portal.',
                                                icon: "warning",
                                                confirmButtonColor: '#691C32',
                                                allowOutsideClick: false,
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    if (btnFormSubmit) {
                                                        btnFormSubmit.disabled = true;
                                                    }
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
            obtieneRFCCompleto() {
                if (document.getElementsByName('tipo_persona').length > 0) {
                    const tipoPersona = document.getElementsByName('tipo_persona')[0].value;
                    if (tipoPersona === 'M') {
                        // Contiene RFC con homoclave
                        return this.rfcText;
                    } else if (tipoPersona === 'F') {
                        // Input value contiene solo homoclave
                        return document.getElementById('rfc_sin_homoclave').value + this.rfcText;
                    }
                }                

                return '';
            }
        }
    }
</script>
