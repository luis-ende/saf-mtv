<div x-data="listaContactos()">
    <input
        type="hidden"
        id="contactos_lista"
        name="contactos_lista"
        x-bind:value="JSON.stringify(contactos)"
    >
    <div class="col-md-2">
        <!-- Button trigger modal -->
        <button type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#contactosModal"
                @click="clearFormFields(); document.getElementById('contactosModalLabel').innerText = 'Agregar contacto';">
            Agregar
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm ">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Primer apellido</th>
                <th scope="col">Segundo apellido</th>
                <th scope="col">Cargo</th>
                <th scope="col">Teléfono oficina</th>
                <th scope="col">Extensión</th>
                <th scope="col">Teléfono móvil</th>
                <th scope="col">Correo electrónico</th>
            </tr>
            </thead>
            <tbody>
                <template x-for="contacto in contactos" :key="contacto.id">
                    <tr>
                        <td x-text="contacto.nombre"></td>
                        <td x-text="contacto.primer_ap"></td>
                        <td x-text="contacto.segundo_ap"></td>
                        <td x-text="contacto.cargo"></td>
                        <td x-text="contacto.telefono_oficina"></td>
                        <td x-text="contacto.extension"></td>
                        <td x-text="contacto.telefono_movil"></td>
                        <td x-text="contacto.email"></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#contactosModal" @click="event.preventDefault; editaContacto(contacto.id)">Editar</a><span> / </span>
                            <a href="#" @click="event.preventDefault; eliminaContacto(contacto.id)">Eliminar</a>
                        </td>
                    <tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contactosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contactosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactosModalLabel">Contactos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contacto_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" maxlength="120" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_primer_ap">Primer apellido:</label>
                        <input type="text" class="form-control" id="contacto_primer_ap" name="contacto_primer_ap" maxlength="60" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_segundo_ap">Segundo apellido:</label>
                        <input type="text" class="form-control" id="contacto_segundo_ap" name="contacto_segundo_ap" maxlength="60" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_cargo">Cargo:</label>
                        <input type="text" class="form-control" id="contacto_cargo" name="contacto_cargo" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_telefono_oficina">Teléfono oficina:</label>
                        <input type="text" class="form-control" id="contacto_telefono_oficina" name="contacto_telefono_oficina" maxlength="15" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_extension">Extensión:</label>
                        <input type="text" class="form-control" id="contacto_extension" name="contacto_extension" maxlength="8">
                    </div>
                    <div class="form-group">
                        <label for="contacto_telefono_movil">Teléfono móvil:</label>
                        <input type="text" class="form-control" id="contacto_telefono_movil" name="contacto_telefono_movil" maxlength="12" data-contacto-campo-requerido="1">
                    </div>
                    <div class="form-group">
                        <label for="contacto_email">Correo electrónico:</label>
                        <input type="email" class="form-control" id="contacto_email" name="contacto_email" data-contacto-campo-requerido="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="agregaContacto()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function listaContactos() {
        return {
            contactos: [],

            agregaContacto() {
                let contacto = {
                        'id': this.contactos.length + 1,
                        'nombre': document.getElementById('contacto_nombre').value,
                        'primer_ap': document.getElementById('contacto_primer_ap').value,
                        'segundo_ap': document.getElementById('contacto_segundo_ap').value,
                        'cargo': document.getElementById('contacto_cargo').value,
                        'telefono_oficina': document.getElementById('contacto_telefono_oficina').value,
                        'extension': document.getElementById('contacto_extension').value,
                        'telefono_movil': document.getElementById('contacto_telefono_movil').value,
                        'email': document.getElementById('contacto_email').value,
                };
                if (this.validaContacto(contacto)) {
                    this.contactos.push(contacto);
                }
            },
            editaContacto(id) {
                document.getElementById('contactosModalLabel').innerText = 'Editar contacto';
                let contacto = this.contactos.find(item => item.id === id);
                if (contacto) {
                    if (this.validaContacto(contacto)) {
                        document.getElementById('contacto_nombre').value = contacto.nombre;
                        document.getElementById('contacto_primer_ap').value = contacto.primer_ap;
                        document.getElementById('contacto_segundo_ap').value = contacto.segundo_ap;
                        document.getElementById('contacto_cargo').value = contacto.cargo;
                        document.getElementById('contacto_telefono_oficina').value = contacto.telefono_oficina;
                        document.getElementById('contacto_extension').value = contacto.extension;
                        document.getElementById('contacto_telefono_movil').value = contacto.telefono_movil;
                        document.getElementById('contacto_email').value = contacto.email;
                    }
                }
            },
            eliminaContacto(id) {
                this.contactos = this.contactos.filter(item => item.id !== id);
            },
            validaContacto(contacto) {
                let invalidValues = [];
                let inputElements = document.querySelectorAll('input[data-contacto-campo-requerido="1"]');
                let invalidState = false;
                inputElements.forEach(el => {
                    if (el.value === '') {
                        invalidValues.push(el.name);
                    }
                });

                invalidState = invalidValues.length > 0;

                if (invalidState) {
                    Swal.fire({
                        title: 'Campos requeridos',
                        html: 'Por favor completa los campos faltantes.',
                        icon: "error",
                    })
                }

                return invalidState;
            },
            clearFormFields() {
                document.getElementById('contacto_nombre').value = '';
                document.getElementById('contacto_primer_ap').value = '';
                document.getElementById('contacto_segundo_ap').value = '';
                document.getElementById('contacto_cargo').value = '';
                document.getElementById('contacto_telefono_oficina').value = '';
                document.getElementById('contacto_extension').value = '';
                document.getElementById('contacto_telefono_movil').value = '';
                document.getElementById('contacto_email').value = '';
            },
        }
    }
</script>
