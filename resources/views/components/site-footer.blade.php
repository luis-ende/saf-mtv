<footer class="text-mtv-gold-light">
    <div class="p-3 bg-mtv-secondary-dark">
        <div class="flex flex-row">
            <div class="basis-1/12 text-white self-end">   
                 @svg('logotipo_CDMX_blanco', ['class' => 'object-fill'])
                {{-- <img class="object-fill" src="https://tianguisdigital.finanzas.cdmx.gob.mx/themes/base/assets/images/logo_adip_finanzas_cg.png" alt="Imagen CDMX"> --}}
            </div>
            <div class="basis-11/12 flex flex-col">
                <label class="w-full basis-full font-bold text-lg text-center">
                    Si tienes preguntas, comentarios o problemas técnicos, queremos ayudarte. Te proporcionamos los medios de contacto a tu disposición:
                </label>
                <div class="basis-full flex flex-row space-x-5 text-center text-lg">                    
                    <div class="basis-1/4">
                        Añil 168, Centro, Iztacalco, 08400, CDMX
                    </div>
                    <div class="basis-1/4">
                        55-5134-2600, 55-5723-6565 Ext. 5004, 5026
                    </div>
                    <div class="basis-1/4">
                        proveedores_cdmx@finanzas.cdmx.gob.mx
                    </div>
                    <div class="basis-1/4">
                        Preguntas frecuentes
                    </div>
                </div>
            </div>            
        </div>        
    </div>    
    <div class="bg-mtv-secondary flex flex-row px-3 py-1">
        <div class="basis-1/2 flex flex-row justify-start space-x-5">
            <span>Términos y condiciones</span>
            <span>Política de privacidad</span>
        </div>        
        <div class="basis-1/2 flex flex-row justify-end space-x-5">
            <span>Diseñado y operado por la Secretaría de Administración y Finanzas</span>
            <span>{{ now()->year }} Gobierno de la CDMX</span>
        </div>        
    </div>
</footer>
