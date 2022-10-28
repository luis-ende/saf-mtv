<div x-data="rfcValidacion()">
       <x-rfc-input
              x-model="rfcText"
              @blur="rfcExiste()" />

       <input id="rfc_existe_en_padron" type="hidden" x-model="rfcExisteEnPadronProveedores" />

       <p class="alert alert-warning" x-show="rfcExisteEnPadronProveedores">
            <span class="fw-bold" x-text="rfcText" >
            </span> Ya cuentas con un registro en el Padrón de Proveedores. Puedes enviar la información de tu catálogo en el perfil de tu negocio.</span>
        </p>
</div>

<script>
    function rfcValidacion() {
        return {
            rfcExisteEnPadronProveedores: false,
            rfcText: '',

            rfcExiste() {
                this.rfcExisteEnPadronProveedores = false;
                console.log('rfcExiste()');

                if (this.rfcText !== '') {
                    fetch('/api/proveedores/' + this.rfcText)
                            .then((res) => res.json())
                            .then((res) => {
                                this.rfcExisteEnPadronProveedores = res[0] === 1;
                            })
                }
            },
        }
    }
</script>
