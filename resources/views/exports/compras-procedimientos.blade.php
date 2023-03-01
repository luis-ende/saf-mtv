<table>
    <thead>
        @isset($unidad_compradora)
            <tr>
                <th>Institución compradora: {{ $unidad_compradora }}</th>
            </tr>
        @endisset
        <tr>
            <th style="background-color: #D3D3D3; font-weight: bold; width: 500px">Objeto de contratación proyectado</th>
            <th style="background-color: #D3D3D3; font-weight: bold">Tipo de contratación</th>
            <th style="background-color: #D3D3D3; font-weight: bold">Procedimiento de contratación proyectado</th>
            <th style="background-color: #D3D3D3; font-weight: bold">Realizar procedimiento de contratación</th>
            <th style="background-color: #D3D3D3; font-weight: bold">Inicio de vigencia del contrato</th>
            <th style="background-color: #D3D3D3; font-weight: bold">Finalización del contrato</th>
        </tr>
    </thead>
    <tbody>
    @foreach($procedimientos as $procedimiento)
        <tr>
            <td>{{ $procedimiento->objeto_contratacion }}</td>
            <td>{{ $procedimiento->tipo_contratacion }}</td>
            <td>{{ $procedimiento->metodo_contr_proyectado }}</td>
            <td>{{ $procedimiento->fecha_estimada_procedimiento }}</td>
            <td>{{ $procedimiento->fecha_estimada_inicio_contr }}</td>
            <td>{{ $procedimiento->fecha_estimada_fin_contr }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
