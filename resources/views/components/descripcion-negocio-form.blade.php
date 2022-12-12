@props(['mode' => 'wizard', 'step' => null, 'wizard', 'grupos_prioritarios' => [], 'tipos_pyme' => [], 'sectores' => []])

@php($grupoPrioritarioId = isset($perfilNegocio) ? $perfilNegocio->id_grupo_prioritario : ( isset($step) ? $step['id_grupo_prioritario'] : old('id_grupo_prioritario')))
@php($tipoPymeId = isset($perfilNegocio) ? $perfilNegocio->id_tipo_pyme : ( isset($step) ? $step['id_tipo_pyme'] : old('id_tipo_pyme')))
@php($sectorId = isset($perfilNegocio) ? $perfilNegocio->id_sector : ( isset($step) ? $step['id_sector'] : old('id_sector')))
@php($diferenciadores = isset($perfilNegocio) ? $perfilNegocio->diferenciadores : ( isset($step) ? $step['diferenciadores'] : old('diferenciadores')))
@php($lema = isset($perfilNegocio) ? $perfilNegocio->lema_negocio : ( isset($step) ? $step['lema_negocio'] : old('lema_negocio')))
@php($nombreNegocio = isset($perfilNegocio) ? $perfilNegocio->nombre_negocio : ( isset($step) ? $step['nombre_negocio'] : old('nombre_negocio')))
@php($descripcionNegocio = isset($perfilNegocio) ? $perfilNegocio->descripcion_negocio : ( isset($step) ? $step['descripcion_negocio'] : old('descripcion_negocio')))
@php($sitio_web = isset($perfilNegocio) ? $perfilNegocio->sitio_web : ( isset($step) ? $step['sitio_web'] : old('sitio_web')))
@php($cuenta_facebook = isset($perfilNegocio) ? $perfilNegocio->cuenta_facebook : ( isset($step) ? $step['cuenta_facebook'] : old('cuenta_facebook')))
@php($cuenta_twitter = isset($perfilNegocio) ? $perfilNegocio->cuenta_twitter : ( isset($step) ? $step['cuenta_twitter'] : old('cuenta_twitter')))
@php($cuenta_linkedin = isset($perfilNegocio) ? $perfilNegocio->cuenta_linkedin : ( isset($step) ? $step['cuenta_linkedin'] : old('cuenta_linkedin')))
@php($num_whatsapp = isset($perfilNegocio) ? $perfilNegocio->num_whatsapp : ( isset($step) ? $step['num_whatsapp'] : old('num_whatsapp')))
@php($logotipoUrl = isset($perfilNegocio) ? $perfilNegocio->getFirstMediaUrl('logotipos') : ( isset($step) ? $step['logotipo_path'] : null))
@php($cartaPresentacion = isset($perfilNegocio) ? $perfilNegocio->getFirstMedia('documentos') : ( isset($step) ? $step['carta_presentacion'] : null))

@isset ($step)
    @php($grupos_prioritarios = $step['grupos_prioritarios'])
@endisset

@isset ($step)
    @php($tipos_pyme = $step['tipos_pyme'])
@endisset

@isset ($step)
    @php($sectores = $step['sectores'])
@endisset

@if ($mode === 'wizard')
    @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'descripcion-negocio']))
@elseif ($mode === 'edit')
    @php($formAction = route('descripcion-negocio.update'))
@endif

<div x-data="descripcionNegocioReglas()" x-init="initModalForm()">
    <div class="flex flex-row flex-wrap">
        <div class="md:basis-1/4 xs:basis-full mt-3 px-8">
            <x-input-image-viewer
                :id="__('logotipo')"
                :name="__('logotipo')"
                :image_url="$logotipoUrl"
            />
            <input type="hidden" id="logotipo_path" name="logotipo_path" value="{{ $logotipoUrl ?? '' }}">
            <label class="to-mtv-text-gray my-2">Sitio web y redes sociales</label>
            <div class="flex flex-row flex-nowrap justify-between mb-3 text-mtv-gold cursor-pointer">
                @svg('iconoir-internet', ['class' => 'h-5 w-5', '@click' => "event.preventDefault(); showFormEdit('sitio_web')"])
                @svg('iconpark-facebookone-o', ['class' => 'h-5 w-5', '@click' => "event.preventDefault(); showFormEdit('cuenta_facebook')"])
                @svg('bi-twitter', ['class' => 'h-5 w-5', '@click' => "event.preventDefault(); showFormEdit('cuenta_twitter')"])
                @svg('antdesign-linkedin-o', ['class' => 'h-5 w-5', '@click' => "event.preventDefault(); showFormEdit('cuenta_linkedin')"])
                @svg('ri-whatsapp-line', ['class' => 'h-5 w-5', '@click' => "event.preventDefault(); showFormEdit('num_whatsapp')"])
            </div>
        </div>
        <div class="md:basis-3/4 xs:basis-full row mx-0">
            <div class="form-group col-md-4">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_grupo_prioritario" name="id_grupo_prioritario" x-model="grupoPrioritario" required>
                        <option value="0">-- Ninguno --</option>
                        @foreach ((array) $grupos_prioritarios as $grupo)
                            <option
                                value={{ $grupo['id'] }}
                            >{{ $grupo['grupo'] }}</option>
                        @endforeach
                    </select>
                    <label class="mtv-input-label" for="id_grupo_prioritario">¿Perteneces a algún sector prioritario?</label>
                </div>
            </div>
            <div class="form-group col-md-4" x-show="grupoPrioritario == grupoPrioritarioMIPYMEId">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_tipo_pyme" name="id_tipo_pyme" x-model="tipoPyme">
                        <option selected value="0">-- Seleccionar --</option>
                        @foreach ((array) $tipos_pyme as $tipo)
                            <option
                                value={{ $tipo['id'] }}
                            >{{ $tipo['tipo_pyme'] }}</option>
                        @endforeach
                    </select>
                    <label class="mtv-input-label" for="id_tipo_pyme">Tipo</label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_sector" name="id_sector" x-model="sector">
                        <option selected value="0">-- Seleccionar --</option>
                        @foreach ((array) $sectores as $sector)
                            <option
                                value={{ $sector['id'] }}
                            >{{ $sector['sector'] }}</option>
                        @endforeach
                    </select>
                    <label class="mtv-input-label" for="id_sector">Sector</label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="mtv-input-wrapper">
                    <select class="mtv-text-input" id="id_categoria_scian" name="id_categoria_scian">
                        <option selected value="0">-- Seleccionar --</option>
                    </select>
                    <label class="mtv-input-label" for="id_categoria_scian">Giro</label>
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
                <x-diferenciadores-input :diferenciadores="$diferenciadores" />
            </div>
            <div class="form-group col-md-12 w-full"
                 x-data="{ cartaPresentacion: {{ $cartaPresentacion ? "'" . $cartaPresentacion->file_name . "'" : 'null' }} }">
                <label class="text-mtv-text-gray my-3">
                    ¿Quieres subir tu carta de presentación? Agrégala en formato PDF de hasta 3MB.
                </label>
                <div class="flex flex-row justify-start text-mtv-gold font-bold">
                    <div class="flex flex-row cursor-pointer"
                         @click="$refs.inputCartaPresentacion.click()"
                    >
                        @svg('uiw-paper-clip', ['class' => 'h-9 w-9 mr-3'])
                        <span class="w-full self-center">Adjuntar documento</span>
                        <input id="carta_presentacion" name="carta_presentacion"
                               class="invisible"
                               type="file" accept="application/pdf"
                               x-ref="inputCartaPresentacion"
                               @change="cartaPresentacion = $event.target.value.replace(/^.*[\\\/]/, '')"
                        >
                        <input id="eliminar_carta"
                               name="eliminar_carta"
                               type="hidden"
                               x-bind:value="cartaPresentacion === null ? 1 : 0">
                    </div>
                </div>
                <div class="text-mtv-text-gray" x-show="cartaPresentacion !== null">
                    @svg('uiw-paper-clip', ['class' => 'h-3 w-3 inline-block mr-5'])
                    <label class="font-bold" x-text="cartaPresentacion"></label>
                    @svg('sui-cross', [
                        'class' => 'h-3 w-3 inline-block ml-3 cursor-pointer',
                        '@click' => "document.getElementById('carta_presentacion').value = null; cartaPresentacion = null"
                    ])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="negocioLinksModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="negocioLinksModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-mtv-gray-light">
                    <h5 class="modal-title" id="negocioLinksModalLabel">Agrega tu sitio web y redes sociales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            negocioLinksModalForm: new bootstrap.Modal(document.getElementById('negocioLinksModal'), { keyboard: true }),
            currentLinkInput: null,
            grupoPrioritarioMIPYMEId: 1,
            grupoPrioritario: {{ $grupoPrioritarioId ?? 0 }},
            tipoPyme: {{ $tipoPymeId ?? 0 }},
            sector: {{ $sectorId ?? 0 }},
            diferenciadores: '',

            closeFormEdit() {
                this.negocioLinksModalForm.hide();
            },
            showFormEdit(inputId) {                                
                this.currentLinkInput = inputId;                
                this.negocioLinksModalForm.show();                
            },
            initModalForm() {
                document.getElementById('negocioLinksModal').addEventListener('shown.bs.modal', () => {                    
                    if (this.currentLinkInput) {                        
                        document.getElementById(this.currentLinkInput).focus();
                    }                    
                });                
            }
        }
    }
</script>
