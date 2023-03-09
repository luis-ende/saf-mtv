<div x-cloak class="modal fade" id="funcionarioModal"
     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="funcionarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mtv-primary text-white text-sm text-uppercase font-bold py-1 px-3">
                <h5 class="modal-title font-bold" id="funcionarioModalLabel" x-text="funcionarioDetalle?.unidad_compradora"></h5>
                <button type="button" class="text-white font-bold" @click="funcionarioModalForm.hide()" aria-label="Close">
                    @svg('sui-cross', ['class' => 'w-7 h-7 stroke-2'])
                </button>
            </div>
            <div id="funcionarioFormContainer" class="modal-body row">
                <div class="border-b">
                    <label class="text-uppercase text-mtv-primary font-bold">Nombre</label>
                    <p class="text-mtv-text-gray text-uppercase"
                       x-text="funcionarioDetalle?.nombre"></p>
                    <label class="text-uppercase text-mtv-primary font-bold">Puesto</label>
                    <p class="text-mtv-text-gray text-uppercase"
                       x-text="funcionarioDetalle?.puesto"></p>
                    <label class="text-uppercase text-mtv-primary font-bold">Funciones</label>
                    <p class="text-mtv-text-gray"
                       x-html="funcionarioDetalle?.funciones"></p>
                </div>
                <div class="flex flex-row font-bold text-mtv-secondary space-x-5 my-3 justify-content-around">
                    <a class="mtv-link-gold text-mtv-secondary flex flex-col items-center space-y-3"
                       :href="'tel:' + funcionarioDetalle?.telefono_oficina"
                    >
                        <span x-text="funcionarioDetalle?.telefono_oficina"></span>
                        @svg('bx-phone-call', ['class' => 'w-7 h-7'])
                    </a>
                    <a class="mtv-link-gold text-mtv-secondary flex flex-col items-center space-y-3"
                       :href="'mailto:' + funcionarioDetalle?.email"
                    >
                        <span x-text="funcionarioDetalle?.email"></span>
                        @svg('gmdi-mark-email-read', ['class' => 'w-7 h-7 block'])
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>