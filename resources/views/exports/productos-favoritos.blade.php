<table>
    <thead>
    <tr>
        <th style="background-color: #D3D3D3; font-weight: bold; width: fit-content">No</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 300px">PRODUCTO</th>
        <th style="background-color: #D3D3D3; font-weight: bold">BIEN/SERVICIO</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 400px">Categoría</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Partida</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 100px">Clave CABMS</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 400px">Nombre de la Clave CABMS</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 400px">Descripción</th>
    </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->row_number }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->tipo === 'B' ? 'BIEN' : ($producto->tipo === 'S' ? 'SERVICIO' : '') }}</td>
            <td>{{ $producto->categoria }}</td>
            <td>{{ $producto->partida }}</td>
            <td>{{ $producto->cabms }}</td>
            <td>{{ $producto->nombre_cabms }}</td>
            <td style="word-wrap: break-word;">{{ $producto->descripcion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
