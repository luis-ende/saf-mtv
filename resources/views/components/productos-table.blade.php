@props(['productos' => []])

<div x-data="columnActions()" class="table-responsive">
    <table class="table table-striped table-sm ">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Clave CABMS</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td class="font-bold">{{ $loop->index + 1 }}</td>
            <td>{{ $producto->clave_cabms }}</td>
            <td>{{ $producto->tipo === 'B' ? 'Bien' : ($producto->tipo === 'S' ? 'Servicio' : '') }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td class="text-right">{{ $producto->precio }}</td>
            <td>
                <div class="flex flex-row justify-end">
                    <a href="{{ route('productos.edit', [$producto->id]) }}"
                       class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                        @svg('heroicon-m-pencil-square', ['class' => 'h-5 w-5 inline-block mr-3'])
                    </a>
                    <form id="producto_destroy_form_{{ $producto->id }}" action="{{ route('productos.destroy', [$producto->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('productos.destroy', [$producto->id]) }}"
                           @click="removeRow($event, {{ $producto->id }}); $event.preventDefault()"
                           class="text-mtv-text-gray text-base no-underline hover:text-mtv-secondary">
                            @svg('heroicon-o-trash', ['class' => 'h-5 w-5 inline-block'])
                        </a>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function columnActions() {
        return {
            removeRow(e, id) {
                Swal.fire({
                    ...SwalMTVCustom,
                    title: 'Eliminar producto',
                    html: '<span>¿Deseas eliminar el producto de tu catálogo?</span>',
                }).then((result) => {
                    if (result.isConfirmed) {                        
                        this.sendDeleteRequest(e, id);
                    }
                })
            },
            sendDeleteRequest(e, id) {
                document.getElementById('producto_destroy_form_' + id).submit();
            }

        }
    }
</script>
