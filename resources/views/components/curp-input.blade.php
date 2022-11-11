<div x-data="curpConsulta()">
    <span x-show="isLoading" class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
    <input id="curp"
           name="curp"
           type="text"
           placeholder="CURP"
           minlength="18"
           maxlength="18"
           x-model="curpText"
           @keyup="mensajeError = ''; limpiaCURPCampos();"
           @blur="buscaCURP()"
           oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'form-control']) !!}>
    <label x-text="mensajeError" class="text-sm text-red-600 space-y-1"></label>
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
                        .then((res) => { console.log('response 1: '+ res.status); return res.json(); })
                        .then((res) => {
                            console.log('response 2');
                            this.isLoading = false;
                            if (res['error']) {
                                this.mensajeError = 'Servicio de consulta de CURP no disponible.'
                            } else {
                                if (res['curp_invalido'] || res['curp_no_localizado']) {
                                    this.mensajeError = "CURP inválida o no localizada."
                                    Swal.fire({
                                        icon: "error",
                                        title: this.curpText,
                                        html: "CURP inválida o no localizada.",
                                    })
                                } else {
                                    let curpDatos = res['curp_datos'];
                                    document.getElementById('rfc').value = curpDatos['CURP'].substring(0, curpDatos['CURP'].length-8);
                                    document.getElementById('fecha_nacimiento').value = curpDatos['fechNac'];
                                    document.getElementById('genero').value = curpDatos['sexo'];
                                    document.getElementById('nombre').value = curpDatos['nombres'];
                                    document.getElementById('primer_ap').value = curpDatos['apellido1'];
                                    document.getElementById('segundo_ap').value = curpDatos['apellido2'];
                                    document.getElementById('rfc').focus();
                                }
                            }
                        })
                }
            },
            limpiaCURPCampos() {
                document.getElementById('rfc').value = '';
                document.getElementById('fecha_nacimiento').value = '';
                document.getElementById('genero').value = '';
                document.getElementById('nombre').value = '';
                document.getElementById('primer_ap').value = '';
                document.getElementById('segundo_ap').value = '';
            }
        }
    }
</script>
