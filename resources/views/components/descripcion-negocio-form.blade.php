<form method="POST" action="">
    @csrf
    <div class="form-group">
        <label for="lema_negocio">Lema del negocio</label>
        <input type="text" autofocus class="form-control" id="lema_negocio" name="lema_negocio" value="{{ $step['lema_negocio'] ?? old('lema_negocio') }}" required>
        <x-input-error :messages="$errors->get('lema_negocio')" class="mt-2" />
    </div>
    <div class="form-group">
        <label for="descripcion_negocio">Descripción del negocio</label>
        <input type="text" class="form-control" id="descripcion_negocio" name="descripcion_negocio" value="{{ $step['descripcion_negocio'] ?? old('descripcion_negocio') }}" required>
        <x-input-error :messages="$errors->get('descripcion_negocio')" class="mt-2" />
    </div>
    <div class="form-group">
        <label for="diferenciador_empresarial">Diferenciador empresarial</label>
        <input type="text" class="form-control" id="diferenciador_empresarial" name="diferenciador_empresarial" value="{{ $step['diferenciador_empresarial'] ?? old('diferenciador_empresarial') }}">
    </div>
    <div class="form-group">
        <label for="sitio_web">Sitio Web</label>
        <input type="text" class="form-control" id="sitio_web" name="sitio_web" value="{{ $step['sitio_web'] ?? old('sitio_web') }}">
    </div>
    <div class="form-group">
        <label for="cuenta_facebook">Cuenta Facebook</label>
        <input type="text" class="form-control" id="cuenta_facebook" name="cuenta_facebook" value="{{ $step['cuenta_facebook'] ?? old('cuenta_facebook') }}">
    </div>
    <div class="form-group">
        <label for="cuenta_twitter">Cuenta Twitter</label>
        <input type="text" class="form-control" id="cuenta_twitter" name="cuenta_twitter" value="{{ $step['cuenta_twitter'] ?? old('cuenta_twitter') }}">
    </div>
    <div class="form-group">
        <label for="cuenta_linkedin">Cuenta LinkedIn</label>
        <input type="text" class="form-control" id="cuenta_linkedin" name="cuenta_linkedin" value="{{ $step['cuenta_linkedin'] ?? old('cuenta_linkedin') }}">
    </div>
    <div class="form-group">
        <label for="num_whatsapp">Número Whatsapp</label>
        <input type="text" class="form-control" id="num_whatsapp" name="num_whatsapp" value="{{ $step['num_whatsapp'] ?? old('num_whatsapp') }}">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</a>
</form>