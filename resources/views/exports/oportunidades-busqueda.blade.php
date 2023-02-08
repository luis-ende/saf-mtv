<table>
    <thead>
    <tr>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 300px">Institución compradora</th>
        <th style="background-color: #D3D3D3; font-weight: bold; width: 500px">Procedimiento</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Estatus</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Publicación</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Presentación de propuestas</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Tipo de contratación</th>
        <th style="background-color: #D3D3D3; font-weight: bold">Método de contratación</th>        
    </tr>
    </thead>
    <tbody>
    @foreach($oportunidades as $oportunidad)
        <tr>        
            <td>{{ $oportunidad->unidad_compradora }}</td>    
            <td>{{ $oportunidad->nombre_procedimiento }}</td>
            <td>{{ $oportunidad->estatus_contratacion }}</td>
            <td>{{ $oportunidad->fecha_publicacion }}</td>
            <td>{{ $oportunidad->fecha_presentacion_propuestas }}</td>
            <td>{{ $oportunidad->tipo_contratacion }}</td>
            <td>{{ $oportunidad->metodo_contratacion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
