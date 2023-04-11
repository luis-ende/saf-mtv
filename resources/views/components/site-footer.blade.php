<footer class="text-mtv-gold-light">
    <div class="p-3 bg-mtv-secondary-dark">
        <div class="flex flex-row">
            <div class="basis-1/12 text-white self-center">
                @svg('logotipo_CDMX_blanco', ['class' => 'object-fill'])
            </div>
            <div class="basis-11/12 flex flex-col">
                <label class="w-full basis-full font-bold md:text-lg xs:text-sm text-center xs:mb-3">
                    Si tienes preguntas, comentarios o problemas técnicos, queremos ayudarte. Te proporcionamos los
                    medios de contacto a tu disposición:
                </label>
                <div class="basis-full flex md:flex-row xs:flex-col md:space-x-5 text-center md:text-lg xs:text-sm">
                    <div class="md:basis-1/4 xs:mb-3">
                        Añil 168, Centro, Iztacalco, 08400, CDMX
                    </div>
                    <div class="md:basis-1/4 xs:mb-3">
                        55-5134-2600, 55-5723-6565 Ext. 5004, 5026
                    </div>
                    <div class="md:basis-1/4 xs:mb-3">
                        <a href="mailto:proveedores_cdmx@finanzas.cdmx.gob.mx"
                           class="text-mtv-gold-light no-underline hover:text-white active:text-white">
                            proveedores_cdmx@finanzas.cdmx.gob.mx
                        </a>
                    </div>
                    <div class="md:basis-1/4 xs:mb-3">
                        <a href="{{ route('preguntas-frecuentes.show') }}"
                           class="text-mtv-gold-light no-underline hover:text-white active:text-white">
                            Preguntas frecuentes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-mtv-secondary flex flex-row px-3 py-1">
        <div class="basis-1/2 flex flex-row justify-start space-x-5">
            <span>
                <a href="#"
                   class="text-mtv-gold-light no-underline hover:text-white active:text-white">
                    Términos y condiciones
                </a>
            </span>
            <span>
                <a href="{{ route('aviso-privacidad.show') }}"
                   class="text-mtv-gold-light no-underline hover:text-white active:text-white">
                    Política de privacidad
                </a>
            </span>
        </div>
        <div class="basis-1/2 flex flex-row justify-end space-x-5">
            <span>Diseñado y operado por la Secretaría de Administración y Finanzas</span>
            <span>{{ now()->year }} Gobierno de la CDMX</span>
        </div>
</footer>