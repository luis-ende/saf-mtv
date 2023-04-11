<x-app-layout>
    @section('page_title', 'Directorio CDMX')
    <div class="bg-white overflow-hidden min-h-screen flex flex-col mx-auto lg:px-10 px-6 max-w-7xl">
        <div class="py-6 bg-white border-b border-gray-200 flex flex-col">
            <h1 class="text-mtv-primary font-bold text-lg md:text-2xl uppercase my-0">
                Aviso de privacidad simplificado
            </h1>
        </div>
        <div class="text-base text-mtv-text-gray my-10">
            <p>La Secretaría de Administración de Finanzas de la Ciudad de México, a través de la Dirección General de Recursos Materiales y Servicios Generales
                (DGRMSG), es la responsable del tratamiento de los datos personales que nos proporcione, los cuales serán protegidos en el <strong>“Sistema de Datos
                Personales para Personas Físicas y Morales del Padrón de Proveedores de la Administración Pública de la Ciudad de México”</strong>, actualizado el día 10
                de diciembre de 2021, mediante publicación en la Gaceta Oficial de la Ciudad de México.</p>
            <p>Los datos personales que recabamos serán utilizados con la finalidad de generar datos estadísticos de asistencia y resguardar los datos de contacto de las
                personas físicas y morales que asistan a la Feria de Inversión de la Ciudad de México, con el objeto de compartirles información útil y generada por esta
                dependencia, que puede ser de su interés, así como de próximos proyectos y eventos de la Secretaría de Administración y Finanzas.</p>
            <p>Usted podrá manifestar la negativa al tratamiento de sus datos personales directamente ante la Unidad de Transparencia de la Secretaría de
                Administración y Finanzas de la Ciudad de México, ubicada en Plaza de la Constitución número 1, planta baja, Colonia Centro, Alcaldía Cuauhtémoc, C.P.
                06080, Ciudad de México con número telefónico 5553458000 ext. 1384 y 1599, o bien, a través de la <a href="https://www.plataformadetransparencia.org.mx" target="_blank" class="mtv-link-gold underline font-bold">Plataforma Nacional de Transparencia</a> o en el correo
                <a href="mailto:electrónico ut@finanzas.cdmx.gob.mx" class="mtv-link-gold underline font-bold">electrónico ut@finanzas.cdmx.gob.mx</a></p>
            <p>Para conocer el <a href="http://procesos.finanzas.cdmx.gob.mx/OIP/index.php/Datos_Personales" target="_blank" class="mtv-link-gold underline font-bold">Aviso de Privacidad Integral</a> puede acudir directamente a la Unidad de Transparencia.</p>
        </div>
        <button type="button"
                class="mtv-link-gold font-bold text-base my-5"
                onclick="history.back()">
            @svg('fas-arrow-left', ['class' => 'h-5 w-5 inline-block mr-1'])
            Regresar
        </button>
    </div>
</x-app-layout>