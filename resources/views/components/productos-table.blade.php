@props(['productos' => []])

<div x-data="columnActions()" class="table-responsive">
    <table class="table table-striped table-sm ">
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
            <td class="font-bold">{{ $loop->index + 1 }}</td>
            <td>{{ $producto->clave_cabms }}</td>
            <td>{{ $producto->tipo === 'B' ? 'Bien' : ($producto->tipo === 'S' ? 'Servicio' : '') }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td class="text-right">{{ $producto->precio }}</td>
            <td>
                <div class="flex flex-row justify-end">
                    <a href="{{ route('productos.edit', [$producto->id]) }}"
                       class="text-base no-underline hover:text-[#BC955C]">
                        @svg('heroicon-m-pencil-square', ['class' => 'h-5 w-5 inline-block'])
                    </a>{!! "&nbsp;" !!}
                    <form id="producto_destroy_form_{{ $producto->id }}" action="{{ route('productos.destroy', [$producto->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('productos.destroy', [$producto->id]) }}"
                           @click="removeRow($event, {{ $producto->id }}); $event.preventDefault()"
                           class="text-base no-underline hover:text-[#BC955C]">
                            @svg('heroicon-s-trash', ['class' => 'h-5 w-5 inline-block'])
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
                    title: '¿Desea eliminar el producto',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonColor: '#691C32',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {                    
                    if (result.isConfirmed) {                        
                        this.sendDeleteRequest(e, id);                                                                       
                    }                    
                });
            },
            sendDeleteRequest(e, id) {                
                document.getElementById('producto_destroy_form_' + id).submit();                
            }
            
        }
    }
</script>