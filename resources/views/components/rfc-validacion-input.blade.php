@props(['tipo_persona' => 'F'])

<div x-data="rfcValidacion()">
       <x-rfc-input
              x-model="rfcText"
              @blur="rfcExiste()" />

       <input id="rfc_existe_en_padron" type="hidden" x-model="rfcExisteEnPadronProveedores" />

       <p class="alert alert-warning" x-show="rfcExisteEnPadronProveedores">
           <span class="fw-bold" x-text="rfcText" ></span>
           <span> Ya cuentas con un registro en el Padrón de Proveedores (</span>
           <span x-text="rfcEtapaEnPadronProveedores"></span>
           <span>). Puedes enviar la información de tu catálogo en el perfil de tu negocio. Ingresa al </span>
           <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">Padrón de Proveedores</a>
        </p>
        <p class="alert alert-warning" x-show="rfcExisteEnMTV && ! rfcExisteEnPadronProveedores">
            <span class="fw-bold" x-text="rfcText" ></span>
            <span> Ya cuentas con un registro en Mi Tiendita Virtual. </span>
            <a href="{{ route('login') }}">Inicia sesión</a>
            <span> para acceder al portal.</span>
        </p>
</div>

<script>
    function rfcValidacion() {
        return {
            rfcExisteEnPadronProveedores: false,
            rfcEtapaEnPadronProveedores: '',
            rfcExisteEnMTV: false,
            rfcText: '',

            rfcExiste() {
                this.rfcExisteEnPadronProveedores = false;
                this.rfcEtapaEnPadronProveedores = '';
                this.rfcExisteEnMTV = false;

                if (this.rfcText !== '') {
                    fetch('/api/proveedores/' + this.rfcText)
                            .then((res) => res.json())
                            .then((res) => {
                                if (!res['error']) {
                                    this.rfcExisteEnPadronProveedores = res['existe_en_padron_proveedores'];
                                    this.rfcExisteEnMTV = res['existe_en_mtv'];
                                    this.rfcEtapaEnPadronProveedores = res['etapa_en_padron_proveedores'];

                                    document.getElementById('rfc').focus();
                                    document.getElementById('btn_perfil_negocio_siguiente').disabled = !res['permitir_registro'];
                                }
                            })
                }
            },
        }
    }
</script>
