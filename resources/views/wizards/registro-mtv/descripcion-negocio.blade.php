<x-guest-layout>        
    <div class="container">
        <h1>2. Descripción de tu Negocio</h1><br>
        <form method="POST" action="{{ route('wizard.registro-mtv.update', 'descripcion-negocio') }}">
            @csrf

            <div class="form-group">
                <label for="lema_negocio">Lema del negocio</label>
                <input type="text" class="form-control" id="lema_negocio">
            </div>
            <div class="form-group">
                <label for="descripcion_negocio">Descripción del negocio</label>
                <input type="text" class="form-control" id="descripcion_negocio">
            </div>
            <div class="form-group">
                <label for="diferenciador_empresarial">Diferenciador empresarial</label>
                <input type="text" class="form-control" id="contacto">
            </div>
            <div class="form-group">
                <label for="telefono">Sitio Web</label>
                <input type="text" class="form-control" id="telefono">
            </div>            

            <input class="btn btn-primary" type="submit" value="Siguiente">
        </form>
    </div>
</x-guest-layout>