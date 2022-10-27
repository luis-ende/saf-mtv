@props(['productos' => []])


<br>
<div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Clave CABMS</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Categoría</th>
                <th scope="col">Subcategoría</th>
                <th scope="col">Marca</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
            <tr>
                <th scope="row">{{ $producto->id }}</th>                
                <td>{{ $producto->clave_cabms }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->tipo }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>{{ $producto->subcategoria }}</td>
                <td>{{ $producto->marca }}</td>                
                <td><a href="{{ route('productos.edit') }}">Editar</a><span> / </span><a href="#">Eliminar</a><span> / </span><a href="#">Fotos</a></td>
            </tr>
            @endforeach                        
            </tbody>
        </table>
    </div>
</div>