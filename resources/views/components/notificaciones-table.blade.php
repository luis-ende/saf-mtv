@props(['icon_like' => true])

<table class="table table-striped table-sm ">
    <thead class="table-light">
    <tr>
        <th class="text-center" scope="col">Procedimiento</th>
        <th class="text-center" scope="col">
            Notificación
            @svg('gmdi-notifications-active-o', ['class' => 'h-4 w-4 inline-block'])
        </th>
        <th class="text-center" scope="col">Estatus</th>
        <th class="text-center" scope="col">Fecha programada</th>
        <th class="text-center" scope="col">Fecha de inicio</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-sm"><div class="w-fit h-fit bg-[#691C32] rounded text-slate-200 m-0 p-2">Adquisición de Uniformes Secretariales, Trajes para Choferes, Vestuario y Equipo de Seguridad y Trabajo</div></td>
        <td class="text-center">Nuevo procedimiento</td>
        <td class="text-center">Próximo</td>
        <td class="text-center">03/12/2022</td>
        <td class="text-center">10/12/2022</td>
        <td>
            <div class="flex flex-row justify-end">
                @svg('css-link', ['class' => 'h-5 w-5 inline-block mr-1'])
                @if($icon_like)
                    @svg('uiw-like-o', ['class' => 'h-5 w-5 inline-block mr-1'])
                @endif
                @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
            </div>
        </td>
    </tr>
    <tr>
        <td class="text-sm"><div class="w-fit h-fit bg-[#691C32] rounded text-slate-200 m-0 p-2">Póliza de seguro de bienes patrimoniales (edificio, contenidos y parque vehicular) propiedad del Tribunal Electoral de la Ciudad de México.</div></td>
        <td class="text-center">Nuevo procedimiento</td>
        <td class="text-center">Próximo</td>
        <td class="text-center">03/12/2022</td>
        <td class="text-center">10/12/2022</td>
        <td>
            <div class="flex flex-row justify-end items-stretch">
                @svg('css-link', ['class' => 'h-5 w-5 inline-block mr-1'])
                @if($icon_like)
                @svg('uiw-like-o', ['class' => 'h-5 w-5 inline-block mr-1'])
                @endif
                @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
            </div>
        </td>
    </tr>
    </tbody>
</table>
