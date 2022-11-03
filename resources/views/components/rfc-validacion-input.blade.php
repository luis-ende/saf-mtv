@props(['tipo_persona' => 'F', 'value'])

<div x-data="rfcValidacion()">
       <x-rfc-input
              x-model="rfcText"
              @blur="verificaRFC()"
              @keyup="rfcInvalido = ''"
              :value="$value" />
       <label x-text="rfcInvalido != '' ? 'No es posible registrar el RFC en Mi Tiendita Virtual.' : ''" class="text-sm text-red-600 space-y-1"></label>
</div>

<script>
    function rfcValidacion() {
        return {
            rfcExisteEnPadronProveedores: false,
            rfcEtapaEnPadronProveedores: '',
            rfcExisteEnMTV: false,
            rfcText: document.getElementById('rfc').value,
            rfcInvalido: '',

            verificaRFC() {
                this.rfcExisteEnPadronProveedores = false;
                this.rfcEtapaEnPadronProveedores = '';
                this.rfcExisteEnMTV = false;
                this.rfcInvalido = '';
                document.getElementById('btn_perfil_negocio_siguiente').disabled = false;

                if (this.rfcText !== '') {
                    fetch('/api/proveedores/' + this.rfcText)
                            .then((res) => res.json())
                            .then((res) => {
                                if (!res['error']) {
                                    this.rfcExisteEnPadronProveedores = res['existe_en_padron_proveedores'];
                                    this.rfcExisteEnMTV = res['existe_en_mtv'];
                                    this.rfcEtapaEnPadronProveedores = res['etapa_en_padron_proveedores'];                                    

                                    if (!res['permitir_registro']) {
                                        this.rfcInvalido = res['rfc'];
                                        
                                        if (this.rfcExisteEnPadronProveedores) {
                                            Swal.fire({
                                                title: this.rfcInvalido,
                                                html: "Ya cuentas con un registro en el Padrón de Proveedores ("
                                                    + this.rfcEtapaEnPadronProveedores + "). " +
                                                    "Puedes enviar la información de tu catálogo en el perfil de tu negocio. " +
                                                    '<a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">Padrón de Proveedores</a>.',
                                                icon: "warning",
                                                allowOutsideClick: false,
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('btn_perfil_negocio_siguiente').disabled = true;
                                                }
                                            })
                                        } else if (this.rfcExisteEnMTV) {
                                            Swal.fire({
                                                title: this.rfcInvalido,
                                                html: 'Ya cuentas con un registro en Mi Tiendita Virtual. <br><a href="{{ route('login') }}">Inicia sesión</a> para acceder al portal.',
                                                icon: "warning",
                                                allowOutsideClick: false,
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('btn_perfil_negocio_siguiente').disabled = true;
                                                }
                                            })
                                        }
                                    }
                                }
                            })
                }
            },
        }
    }
</script>
