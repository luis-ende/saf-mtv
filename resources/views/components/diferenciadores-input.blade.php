@props(['diferenciadores' => ''])

@php($diferenciadores = $diferenciadores !== '' ? explode(',', $diferenciadores) : [])

<div class="mtv-input-wrapper">
    <input
        x-data="diferenciadoresLista()"
        x-init="inicializaLista()"        
        type="text"
        class="mtv-text-input"
        id="diferenciadores"
        name="diferenciadores"
        placeholder="¿Qué te hace diferente de tu competencia? Precio bajos, Atención al cliente, Certificaciones, Capacitación, etc."
    >
    <label class="mtv-input-label" for="diferenciadores">Diferencias que distinguen tu negocio</label>
</div>

<label class="text-xs text-slate-500 italic" for="diferenciadores">Usa Enter para separar las palabras</label>

<script type="text/javascript">    
    function diferenciadoresLista() {
        return {
            arrayDiferenciadores: {!! json_encode($diferenciadores) !!},            
            diferenciadoresChoices: new Choices('#diferenciadores', {
                allowHTML: true,
                loadingText: 'Cargando...',                
                itemSelectText: 'Seleccionar',                
                searchChoices: false,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                classNames: {
                    containerInner: 'choices__inner--categorias choices__inner',
                },
                uniqueItemText: 'No es posible agregar entradas repetidas',
                addItemText: (value) => {
                    return `Presiona Enter para agregar <b>"${value}"</b>`;
                },
            }),
            inicializaLista() {                                
                this.diferenciadoresChoices.setValue(this.arrayDiferenciadores);                
            }
        }
    }

</script>
