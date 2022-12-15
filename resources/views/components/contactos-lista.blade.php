@props(['step' => null, 'persona' => null])

@php($contactosLista = isset($persona) ? $persona->contactos : ( isset($step) ? $step['contactos_lista'] : old('contactos_lista')))
@php($contactosLista = !$contactosLista ? json_decode('[]') : json_decode($contactosLista))

<div x-data="listaContactos()" x-init="initModalForm()">
    <x-field-group-card title="Matriz de escalamiento">
        <input
            type="hidden"
            id="contactos_lista"
            name="contactos_lista"
            x-bind:value="JSON.stringify(contactos)"
        >
        <div class="w-full flex flex-col align-items-end px-1 mb-3">
            <!-- Button trigger modal -->
            <button
                class="mtv-button-secondary-white no-underline"
                @click="event.preventDefault(); showFormNew()">
                @svg('heroicon-m-plus-circle', ['class' => 'h-7 w-7 inline-block'])
                Agregar
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead class="table-light">
                <tr class="text-mtv-gray font-normal uppercase">
                    <th scope="col">#</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Teléfono oficina</th>
                    <th scope="col">Extensión</th>
                    <th scope="col">Teléfono móvil</th>
                    <th scope="col">Correo electrónico</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <template x-for="(contacto, index) in contactos" :key="contacto.id">
                    <tr>
                        <td x-text="index + 1"></td>
                        <td x-text="contacto.nombre + ' ' + contacto.primer_ap + ' ' + contacto.segundo_ap"></td>
                        <td x-text="contacto.cargo"></td>
                        <td x-text="contacto.telefono_oficina"></td>
                        <td x-text="contacto.extension"></td>
                        <td x-text="contacto.telefono_movil"></td>
                        <td x-text="contacto.email"></td>
                        <td>
                            <a href="#"
                               data-bs-toggle="modal"
                               data-bs-target="#contactosModal"
                               @click="event.preventDefault(); editaContacto(contacto.id)" aria-label="Editar"
                               class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                @svg('carbon-edit', ['class' => 'h-5 w-5 inline-block mr-3'])
                            </a>
                            <a href="#" @click="event.preventDefault(); eliminaContacto(contacto.id)"
                               aria-label="Eliminar"
                               class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                                @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                            </a>
                        </td>
                    <tr>
                </template>
                </tbody>
            </table>
        </div>
    </x-field-group-card>

    <!-- Modal -->
    <div class="modal fade" id="contactosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contactosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-mtv-gray-light">
                    <h5 class="modal-title" id="contactosModalLabel">Contactos</h5>
                    <button type="button" class="btn-close" @click="contactosModalForm.hide()" aria-label="Close"></button>
                </div>
                <div id="contactoFormContainer" class="modal-body row">
                    <input type="hidden" id="contacto_id" name="contacto_id">
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="contacto_nombre" name="contacto_nombre" maxlength="120" data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_nombre">Nombre</label>
                        </div>
                        <label x-show="errors['contacto_nombre']" x-text="errors['contacto_nombre']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="contacto_primer_ap" name="contacto_primer_ap" maxlength="60" data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_primer_ap">Primer apellido</label>
                        </div>
                        <label x-show="errors['contacto_primer_ap']" x-text="errors['contacto_primer_ap']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="contacto_segundo_ap" name="contacto_segundo_ap" maxlength="60" data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_segundo_ap">Segundo apellido</label>
                        </div>
                        <label x-show="errors['contacto_segundo_ap']" x-text="errors['contacto_segundo_ap']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="contacto_cargo" name="contacto_cargo" data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_cargo">Cargo</label>
                        </div>
                        <label x-show="errors['contacto_cargo']" x-text="errors['contacto_cargo']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="email" class="mtv-text-input" id="contacto_email" name="contacto_email" data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_email">Correo electrónico</label>
                        </div>
                        <label x-show="errors['contacto_email']" x-text="errors['contacto_email']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-8">
                        <div class="mtv-input-wrapper">
                            <input
                                type="text"
                                class="mtv-text-input"
                                id="contacto_telefono_oficina"
                                name="contacto_telefono_oficina"
                                maxlength="13"
                                placeholder="_ _ - _ _ _ _ _ _ _ _"
                                x-mask="99-99999999"
                                data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_telefono_oficina">Teléfono oficina</label>
                        </div>
                        <label x-show="errors['contacto_telefono_oficina']" x-text="errors['contacto_telefono_oficina']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="mtv-input-wrapper">
                            <input type="text" class="mtv-text-input" id="contacto_extension" name="contacto_extension" maxlength="8">
                            <label class="mtv-input-label" for="contacto_extension">Extensión</label>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <div class="mtv-input-wrapper">
                            <input
                                type="text"
                                class="mtv-text-input"
                                id="contacto_telefono_movil"
                                name="contacto_telefono_movil"
                                maxlength="13"
                                placeholder="_ _ - _ _ _ _ _ _ _ _"
                                x-mask="99-99999999"
                                data-contacto-campo-requerido="1">
                            <label class="mtv-input-label" for="contacto_telefono_movil">Teléfono móvil</label>
                        </div>
                        <label x-show="errors['contacto_telefono_movil']" x-text="errors['contacto_telefono_movil']" class="text-sm text-red-600 space-y-1"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mtv-button-secondary" @click="guardaContacto()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function listaContactos() {

        return {
            contactos: {!! json_encode($contactosLista) !!},
            contactosModalForm: new bootstrap.Modal(document.getElementById('contactosModal'), { keyboard: true }),
            errors: {},

            guardaContacto() {
                let contacto = {};
                let contactoId = document.getElementById('contacto_id').value;
                let esNuevoContacto = contactoId == 0;
                if (esNuevoContacto) {
                    contacto['id'] = this.contactos.length + 1;
                } else {
                    contacto = this.contactos.find(item => item.id == contactoId);
                }

                contacto['nombre'] = document.getElementById('contacto_nombre').value;
                contacto['primer_ap'] = document.getElementById('contacto_primer_ap').value;
                contacto['segundo_ap'] = document.getElementById('contacto_segundo_ap').value;
                contacto['cargo'] = document.getElementById('contacto_cargo').value;
                contacto['telefono_oficina'] = document.getElementById('contacto_telefono_oficina').value;
                contacto['extension'] = document.getElementById('contacto_extension').value;
                contacto['telefono_movil'] = document.getElementById('contacto_telefono_movil').value;
                contacto['email'] = document.getElementById('contacto_email').value;

                if (this.validaContacto(contacto)) {
                    if (esNuevoContacto) {
                        this.contactos.push(contacto);
                    }
                    this.contactosModalForm.hide();
                }
            },
            editaContacto(id) {
                document.getElementById('contactosModalLabel').innerText = 'Editar contacto';
                let contacto = this.contactos.find(item => item.id === id);
                if (contacto) {
                    document.getElementById('contacto_id').value = contacto.id;
                    document.getElementById('contacto_nombre').value = contacto.nombre;
                    document.getElementById('contacto_primer_ap').value = contacto.primer_ap;
                    document.getElementById('contacto_segundo_ap').value = contacto.segundo_ap;
                    document.getElementById('contacto_cargo').value = contacto.cargo;
                    document.getElementById('contacto_telefono_oficina').value = contacto.telefono_oficina;
                    document.getElementById('contacto_extension').value = contacto.extension;
                    document.getElementById('contacto_telefono_movil').value = contacto.telefono_movil;
                    document.getElementById('contacto_email').value = contacto.email;
                }
                this.contactosModalForm.show();
            },
            eliminaContacto(id) {
                Swal.fire({
                    ...SwalMTVCustom,
                    title: 'Eliminar contacto',
                    html: '<span>¿Deseas eliminar el contacto de la matriz de escalamiento?</span>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.contactos = this.contactos.filter(item => item.id !== id);
                    }
                })
            },
            validaContacto(contacto) {
                this.errors = {};
                let invalidValues = [];
                let inputElements = document.querySelectorAll('input[data-contacto-campo-requerido="1"]');
                let invalidState = false;
                inputElements.forEach(el => {
                    if (el.value === '') {
                        invalidValues.push(el.labels[0].innerText.replace(':', ''));
                        this.errors[el.name] = 'Requerido';
                    }
                });

                if (contacto.email) {
                    let validRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
                    if (!contacto.email.match(validRegex)) {
                        this.errors['contacto_email'] = 'Correo electrónico no válido';
                        invalidState = true;
                    }
                }

                invalidState = invalidState || invalidValues.length > 0;

                return !invalidState;
            },
            clearFormFields() {
                document.getElementById('contacto_id').value = 0;
                document.getElementById('contacto_nombre').value = '';
                document.getElementById('contacto_primer_ap').value = '';
                document.getElementById('contacto_segundo_ap').value = '';
                document.getElementById('contacto_cargo').value = '';
                document.getElementById('contacto_telefono_oficina').value = '';
                document.getElementById('contacto_extension').value = '';
                document.getElementById('contacto_telefono_movil').value = '';
                document.getElementById('contacto_email').value = '';
            },
            showFormNew() {
                this.clearFormFields();
                document.getElementById('contactosModalLabel').innerText = 'Agrega tus contactos';
                this.contactosModalForm.show();
            },
            getErrors() {
                return this.errors;
            },
            initModalForm() {
                document.getElementById('contactosModal').addEventListener('shown.bs.modal', function () {
                    let formInputs = document.getElementById('contactoFormContainer');
                    Array.from(formInputs.getElementsByTagName('input')).forEach(input => input.disabled = false);
                });
                document.getElementById('contactosModal').addEventListener('hidden.bs.modal', function () {
                    let formInputs = document.getElementById('contactoFormContainer');
                    Array.from(formInputs.getElementsByTagName('input')).forEach(input => input.disabled = true);
                })
            }
        }
    }
</script>
