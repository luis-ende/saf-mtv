@props(['tipo_persona' => 'F', 'value'])

<div x-data="rfcValidacion()">
       <x-rfc-input
              x-model="rfcText"
              @blur="rfcExiste()"
              :value="$value" />

       <div class="alert alert-warning" x-show="rfcExisteEnPadronProveedores" role="alert">
           <span class="fw-bold" x-text="rfcInvalido" ></span>
           <span> Ya cuentas con un registro en el Padrón de Proveedores (</span>
           <span x-text="rfcEtapaEnPadronProveedores"></span>
           <span>). Puedes enviar la información de tu catálogo en el perfil de tu negocio. Ingresa al </span>
           <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">Padrón de Proveedores</a>
        </div>
        <div class="alert alert-warning" x-show="rfcExisteEnMTV && ! rfcExisteEnPadronProveedores" role="alert">
            <span class="fw-bold" x-text="rfcInvalido" ></span>
            <span> Ya cuentas con un registro en Mi Tiendita Virtual. </span>
            <a href="{{ route('login') }}">Inicia sesión</a>
            <span> para acceder al portal.</span>
        </div>
</div>

<script>
    function rfcValidacion() {
        return {
            rfcExisteEnPadronProveedores: false,
            rfcEtapaEnPadronProveedores: '',
            rfcExisteEnMTV: false,
            rfcText: document.getElementById('rfc').value,
            rfcInvalido: '',

            rfcExiste() {
                this.rfcExisteEnPadronProveedores = false;
                this.rfcEtapaEnPadronProveedores = '';
                this.rfcExisteEnMTV = false;
                this.rfcInvalido = '';

                if (this.rfcText !== '') {
                    fetch('/api/proveedores/' + this.rfcText)
                            .then((res) => res.json())
                            .then((res) => {
                                if (!res['error']) {
                                    this.rfcExisteEnPadronProveedores = res['existe_en_padron_proveedores'];
                                    this.rfcExisteEnMTV = res['existe_en_mtv'];
                                    this.rfcEtapaEnPadronProveedores = res['etapa_en_padron_proveedores'];
                                    this.rfcInvalido = res['rfc'];

                                    if (!res['permitir_registro']) {
                                        document.getElementById('rfc').focus();
                                        document.getElementById('btn_perfil_negocio_siguiente').disabled = true;
                                    }
                                }
                            })
                }
            },
        }
    }
</script>
