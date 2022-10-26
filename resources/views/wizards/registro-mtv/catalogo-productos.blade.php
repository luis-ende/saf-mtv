{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <div class="container">
        {{ $wizard['title'] }}
        <h1>3. Tus productos</h1><br>
        @php($wizardId = $wizard['id'])
        <form method="POST" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'catalogo-productos']) }}">
            @csrf

            <div class="form-group">
                <label for="nombre_producto">Producto</label>
                <input type="text" class="form-control" id="nombre_producto">
            </div>

            <input class="btn btn-primary" type="submit" value="Finalizar">
        </form>
    </div>
</x-guest-layout>
