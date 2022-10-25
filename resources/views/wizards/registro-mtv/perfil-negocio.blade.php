<x-guest-layout>        
    <div class="container">
        <h1>1. Perfil de tu Negocio</h1><br>
        <form method="POST" action="{{ route('wizard.registro-mtv.store') }}">
            @csrf

            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" id="rfc">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de contacto</label>
                <input type="text" class="form-control" id="direccion">
            </div>
            <div class="form-group">
                <label for="contacto">Contacto</label>
                <input type="text" class="form-control" id="contacto">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono Fijo</label>
                <input type="text" class="form-control" id="telefono">
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo Electrónico Principal</label>
                <input type="text" class="form-control" id="correo_electronico">
            </div>
            <div class="form-group">
                <label for="grupo_prioritario">Perteneces a algún grupo prioritario</label>
                <select class="form-control" id="grupo_prioritario">
                    <option value="value1">Value 1</option>
                    <option value="value2" selected>Value 2</option>
                    <option value="value3">Value 3</option>
                </select>
            </div>

            <input class="btn btn-primary" type="submit" value="Siguiente">
        </form>
    </div>
</x-guest-layout>