@props(['mode' => 'registro', 'grupos_prioritarios' => [], 'tipos_pyme' => [], 'sectores' => []])

@php($sectorPredeterminado = count($sectores) > 0 ? $sectores[0]->id : null)
@php($grupoPrioritarioId = isset($perfilNegocio) ? $perfilNegocio->id_grupo_prioritario : old('id_grupo_prioritario'))
@php($tipoPymeId = isset($perfilNegocio) ? $perfilNegocio->id_tipo_pyme : old('id_tipo_pyme'))
@php($sectorId = isset($perfilNegocio) ? ($perfilNegocio->id_sector ? $perfilNegocio->id_sector : $sectorPredeterminado) : $sectorPredeterminado)
@php($catSCIANId = isset($perfilNegocio) ? $perfilNegocio->id_categoria_scian : old('id_categoria_scian'))
@php($diferenciadores = isset($perfilNegocio) ? $perfilNegocio->diferenciadores : old('diferenciadores'))
@php($lema = isset($perfilNegocio) ? $perfilNegocio->lema_negocio : old('lema_negocio'))
@php($nombreNegocio = isset($perfilNegocio) ? $perfilNegocio->nombre_negocio : old('nombre_negocio'))
@php($descripcionNegocio = isset($perfilNegocio) ? $perfilNegocio->descripcion_negocio : old('descripcion_negocio'))
@php($sitio_web = isset($perfilNegocio) ? $perfilNegocio->sitio_web : old('sitio_web'))
@php($cuenta_facebook = isset($perfilNegocio) ? $perfilNegocio->cuenta_facebook : old('cuenta_facebook'))
@php($cuenta_twitter = isset($perfilNegocio) ? $perfilNegocio->cuenta_twitter : old('cuenta_twitter'))
@php($cuenta_linkedin = isset($perfilNegocio) ? $perfilNegocio->cuenta_linkedin : old('cuenta_linkedin'))
@php($num_whatsapp = isset($perfilNegocio) ? $perfilNegocio->num_whatsapp : old('num_whatsapp'))
@php($logotipoUrl = isset($perfilNegocio) ? $perfilNegocio->getFirstMediaUrl('logotipos') : null)

<div x-data="descripcionNegocioReglas()" x-init="initDescripcionNegocio()">
    <div class="flex flex-row flex-wrap">
        <div class="md:basis-1/4 xs:basis-full mt-3 md:pr-8 md:pl-0 xs:px-8">
            <x-input-image-viewer
                :id="__('logotipo')"
                :name="__('logotipo')"
                :image_url="$logotipoUrl"
            />
            <input type="hidden" id="logotipo_path" name="logotipo_path" value="{{ $logotipoUrl ?? '' }}">
            @php($svgAttr = [
                'sitio_web' => ['@click' => "event.preventDefault(); showFormEdit('sitio_web')"],
                'cuenta_facebook' => ['@click' => "event.preventDefault(); showFormEdit('cuenta_facebook')"],
                'cuenta_twitter' => ['@click' => "event.preventDefault(); showFormEdit('cuenta_twitter')"],
                'cuenta_linkedin' => ['@click' => "event.preventDefault(); showFormEdit('cuenta_linkedin')"],
                'num_whatsapp' => ['@click' => "event.preventDefault(); showFormEdit('num_whatsapp')"],
            ])
            <x-perfil-negocio.redes-sociales-links
                :svg_attributes="$svgAttr"
            />
        </div>
        <div class="md:basis-3/4 xs:basis-full row mx-0">
            <div class="form-group col-md-4">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_grupo_prioritario" name="id_grupo_prioritario" x-model="grupoPrioritario" required>
                        <option value="0">-- Ninguno --</option>
                        @foreach ((array) $grupos_prioritarios as $grupo)
                            <option
                                value={{ $grupo->id }}
                            >{{ $grupo->grupo }}</option>
                        @endforeach
                    </select>
                    <label class="mtv-input-label" for="id_grupo_prioritario">¿Perteneces a algún sector prioritario?</label>
                </div>
            </div>
            <div class="form-group col-md-4" x-show="grupoPrioritario == grupoPrioritarioMIPYMEId">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_tipo_pyme" name="id_tipo_pyme" x-model="tipoPyme">
                        <option selected value="0">-- Seleccionar --</option>
                        @foreach ((array)$tipos_pyme as $tipo)
                            <option
                                value={{ $tipo['id'] }}
                            >{{ $tipo['tipo_pyme'] }}</option>
                        @endforeach
                    </select>
                    <label class="mtv-input-label" for="id_tipo_pyme">Tipo</label>
                </div>
            </div>
            <div class="form-group col-md-8">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input text-base"
                            id="id_categoria_scian"
                            name="id_categoria_scian"
                            @change="refreshSector($event.target.value)"
                            x-ref="selectCategoriaScian">
                    </select>
                    <label class="mtv-input-label" for="id_categoria_scian">Giro</label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="mtv-input-wrapper">
                    <input type="hidden" id="id_sector" name="id_sector" x-model="sectorId">
                    <input type="text" class="mtv-text-input" id="sector_nombre" x-model="sectorNombre" disabled>
                    <label class="mtv-input-label" for="sector_nombre">Sector</label>
                </div>
            </div>
            <div class="form-group col-md-8">
                <div class="mtv-input-wrapper">
                    <input type="text" class="mtv-text-input" id="nombre_negocio" name="nombre_negocio"
                        value="{{ $nombreNegocio }}" required>
                    <label class="mtv-input-label" for="nombre_negocio">Nombre comercial de tu negocio</label>
                </div>
                <x-input-error :messages="$errors->get('nombre_negocio')" class="mt-2"/>
            </div>
            <div class="form-group col-md-12">
                <div class="mtv-input-wrapper">
                    <input type="text" class="mtv-text-input" id="lema_negocio" name="lema_negocio"
                           placeholder="Eslogan o frase corta y memorable que usas para promocionar tu negocio"
                           value="{{ $lema }}" required>
                    <label class="mtv-input-label" for="lema_negocio">Lema del negocio</label>
                </div>
                <x-input-error :messages="$errors->get('lema_negocio')" class="mt-2"/>
            </div>
            <div class="form-group col-md-12">
                <div class="mtv-input-wrapper">
                    <textarea class="mtv-text-input" id="descripcion_negocio" name="descripcion_negocio"
                              placeholder="Describe tu negocio o actividad en máximo 100 palabras"
                              required>{{ $descripcionNegocio }}</textarea>
                    <label class="mtv-input-label" for="descripcion_negocio">Descripción del negocio</label>
                </div>
                <x-input-error :messages="$errors->get('descripcion_negocio')" class="mt-2"/>
            </div>
            <div class="form-group col-md-12">
                <x-perfil-negocio.diferenciadores-input :diferenciadores="$diferenciadores" />
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="negocioLinksModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="negocioLinksModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-mtv-gray-light">
                    <h5 class="modal-title" id="negocioLinksModalLabel">Agrega tu sitio web y redes sociales</h5>
                    <button type="button" class="btn-close" @click="negocioLinksModalForm.hide()" aria-label="Close"></button>
                </div>
                <div id="contactoFormContainer" class="modal-body row">
                    <input type="hidden" id="contacto_id" name="contacto_id">
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text"
                                   class="mtv-text-input" id="sitio_web"
                                   name="sitio_web" maxlength="255"
                                   value="{{ $sitio_web }}">
                            <label class="mtv-input-label" for="contacto_nombre">Sitio web</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text"
                                   class="mtv-text-input"
                                   id="cuenta_facebook" name="cuenta_facebook"
                                   maxlength="240"
                                   value="{{ $cuenta_facebook }}">
                            <label class="mtv-input-label" for="contacto_nombre">Facebook</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text"
                                   class="mtv-text-input"
                                   id="cuenta_twitter" name="cuenta_twitter"
                                   maxlength="240"
                                   value="{{ $cuenta_twitter }}">
                            <label class="mtv-input-label" for="contacto_nombre">Twitter</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text"
                                   class="mtv-text-input"
                                   id="cuenta_linkedin" name="cuenta_linkedin"
                                   maxlength="240"
                                   value="{{ $cuenta_linkedin }}">
                            <label class="mtv-input-label" for="contacto_nombre">LinkedIn</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="mtv-input-wrapper">
                            <input type="text"
                                   class="mtv-text-input"
                                   id="num_whatsapp" name="num_whatsapp"
                                   maxlength="15"
                                   value="{{ $num_whatsapp }}">
                            <label class="mtv-input-label" for="contacto_nombre">WhatsApp</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mtv-button-secondary" @click="closeFormEdit()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function descripcionNegocioReglas() {
        return {
            sectores: {!! json_encode($sectores) !!},
            categoriasScian: [],
            categoriasScianRoute: '/perfil-negocio/categorias_scian/',
            categoriasScianChoices: new Choices('#id_categoria_scian', {
                allowHTML: false,
                loadingText: 'Cargando...',
                noChoicesText: 'Sin categorías/giros para elegir',
                noResultsText: 'No se encontraron resultados',
                itemSelectText: 'Seleccionar',
                searchResultLimit: 16,
            }),
            negocioLinksModalForm: new bootstrap.Modal(document.getElementById('negocioLinksModal'), { keyboard: true }),
            currentLinkInput: null,
            grupoPrioritarioMIPYMEId: 1,
            grupoPrioritario: {{ $grupoPrioritarioId ?? 0 }},
            tipoPyme: {{ $tipoPymeId ?? 0 }},
            sectorId: {{ $sectorId ?? 0 }},
            sectorNombre: '',
            diferenciadores: '',

            closeFormEdit() {
                this.negocioLinksModalForm.hide();
            },
            showFormEdit(inputId) {
                this.currentLinkInput = inputId;
                this.negocioLinksModalForm.show();
            },
            initDescripcionNegocio() {
                document.getElementById('negocioLinksModal').addEventListener('shown.bs.modal', () => {
                    if (this.currentLinkInput) {
                        document.getElementById(this.currentLinkInput).focus();
                    }
                });

                this.refreshCategoriasScian({{ $catSCIANId }});
            },
            async refreshCategoriasScian(catScianId) {
                this.categoriasScianChoices.clearStore();
                this.categoriasScian = await this.fetchCategoriasScian();
                this.categoriasScianChoices.setChoices(this.categoriasScian);
                this.categoriasScianChoices.setChoiceByValue(catScianId);
                this.refreshSector(catScianId);
            },
            refreshSector(catScianId) {
                const catScian = this.categoriasScian.find(item => item.value == catScianId);
                if (catScian) {
                    this.sectorId = catScian.id_sector;
                    const sector = this.sectores.find(item => item.id == catScian.id_sector);
                    this.sectorNombre = sector.sector;
                }
            },
            async fetchCategoriasScian() {
                try {
                    const items = await fetch(this.categoriasScianRoute);
                    return items.json();
                } catch (err) {
                    console.error(err);
                }
            }
        }
    }
</script>
