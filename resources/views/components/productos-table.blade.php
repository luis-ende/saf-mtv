@props(['productos' => []])

@if(session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif

<br>
<div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Clave CABMS</th>
                <th scope="col">Tipo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
            <tr>
                <th scope="row">{{ $producto->id }}</th>
                <td>{{ $producto->clave_cabms }}</td>
                <td>{{ $producto->tipo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    <a href="{{ route('productos.edit', [$producto->id]) }}">Editar</a><span> / </span>
                    <form id="producto_destroy_form_{{ $producto->id }}" action="{{ route('productos.destroy', [$producto->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('productos.destroy', [$producto->id]) }}"
                           onclick="event.preventDefault();document.getElementById('producto_destroy_form_{{ $producto->id }}').submit();">Eliminar</a>
                    </form>
                    <span> / </span>
                    <a href="#">Fotos</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
