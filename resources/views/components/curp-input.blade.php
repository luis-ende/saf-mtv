<div x-data="curpConsulta()">
    <div class="mtv-input-wrapper relative">
        <input
            id="curp"
            name="curp"
            type="text"
            placeholder="XXXXXXXXXXXXXXXXXX"
            x-mask="aaaa999999aaaaaa99"
            maxlength="18"
            x-model="curpText"
            @keyup="mensajeError = ''; limpiaCURPCampos();"
            @blur="buscaCURP()"
            oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'mtv-text-input']) !!}>
        <label class="mtv-input-label" for="curp">CURP</label>
        <div class="absolute inset-y-0 top-4 right-0 pr-3 flex items-center text-sm leading-5">
            <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
        </div>
    </div>
    <label x-show="mensajeError != ''" x-text="mensajeError" class="text-xs text-red-600 space-y-1"></label>
</div>

<script>
    function curpConsulta() {
        return {
            curpText: document.getElementById('curp').value,
            mensajeError: '',
            isLoading: false,

            buscaCURP() {
                this.mensajeError = '';
                this.isLoading = false;

                if (this.curpText !== '') {
                    this.isLoading = true;
                    fetch('/api/contacto/curp/' + this.curpText)
                        .then((res) => res.json())
                        .then((res) => {
                            this.isLoading = false;
                            if (res['error']) {
                                this.mensajeError = 'Servicio de consulta de CURP no disponible.'
                            } else {
                                if (res['curp_invalido'] || res['curp_no_localizado']) {
                                    this.mensajeError = "CURP inválida o no localizada"
                                    Swal.fire({
                                        ...SwalMTVCustom,
                                        title: this.mensajeError,
                                        html: "Verifique que la CURP introducida sea correcta.",
                                        showCancelButton: false,
                                        confirmButtonText: 'Aceptar',
                                    })
                                } else {
                                    let curpDatos = {
                                        'curp': res['curp_datos']['CURP'],
                                        'nombre': res['curp_datos']['nombres'],
                                        'primer_ap': res['curp_datos']['apellido1'],
                                        'segundo_ap': res['curp_datos']['apellido2'],
                                        'sexo': res['curp_datos']['sexo'],
                                        'fecha_nacimiento': res['curp_datos']['fechNac'],
                                    };

                                    document.getElementById('rfc').value = curpDatos['curp'].substring(0, curpDatos['curp'].length-8);
                                    document.getElementById('rfc').focus();
                                    let inputPersonaDatos = document.getElementById('persona_datos_reg_email');
                                    if (inputPersonaDatos) {
                                        inputPersonaDatos.value = JSON.stringify(curpDatos);
                                    }
                                }
                            }
                        })
                }
            },
            limpiaCURPCampos() {
                document.getElementById('rfc').value = '';
            }
        }
    }
</script>
