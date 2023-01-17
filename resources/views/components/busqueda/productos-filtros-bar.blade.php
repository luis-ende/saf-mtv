<div class="py-3 flex flex-row space-x-2">
    <div class="basis-10/12 flex flex-row space-x-2">
        <div class="w-full flex flex-col" x-data="{ ordenIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="ordenIsOpen=true">
                Ordenar por            
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>            
            </button>            
            <div x-show="ordenIsOpen"
                @click.away="ordenIsOpen = false"
                class="flex flex-col border rounded p-2"> 
                <div class="">
                    <input type="radio" id="html" name="fav_language" value="HTML" checked>
                    <label for="html">Nombre</label><br>
                    <input type="radio" id="css" name="fav_language" value="CSS">
                    <label for="css">CABMS</label><br>
                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                    <label for="javascript">Partida</label> 
                </div>
                <button type="submit"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>        
        </div>

        <div class="w-full flex flex-col" x-data="{ categoriaIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="categoriaIsOpen=true">
                Categoría
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>            
            </button>            
            <div x-show="categoriaIsOpen"
                @click.away="categoriaIsOpen = false"
                class="flex flex-col border rounded p-2"> 
                <div class="h-24 overflow-y-auto">
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Categoría 1</label><br>
                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                    <label for="vehicle2">Categoría 2</label><br>
                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                    <label for="vehicle3">Categoría 3</label>                    
                    <input type="checkbox" id="vehicle4" name="vehicle4" value="Bike">
                    <label for="vehicle4">Categoría 4</label><br>
                    <input type="checkbox" id="vehicle5" name="vehicle5" value="Car">
                    <label for="vehicle5">Categoría 5</label><br>
                    <input type="checkbox" id="vehicle6" name="vehicle6" value="Boat">
                    <label for="vehicle6">Categoría 6</label>                    
                </div>
                <button type="submit"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>        
        </div>

        <div class="w-full flex flex-col" x-data="{ partidaIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="partidaIsOpen=true">
                Partida
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>            
            </button>            
            <div x-show="partidaIsOpen"
                @click.away="partidaIsOpen = false"
                class="flex flex-col border rounded p-2"> 
                <div class="">
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Partida 1</label><br>
                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                    <label for="vehicle2">Partida 2</label><br>
                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                    <label for="vehicle3">Partida 3</label>
                </div>
                <button type="submit"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>        
        </div>
        

        <div class="w-full flex flex-col" x-data="{ sectorIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="sectorIsOpen=true">
                Sector
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>            
            </button>            
            <div x-show="sectorIsOpen"
                @click.away="sectorIsOpen = false"
                class="flex flex-col border rounded p-2"> 
                <div class="">
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Sector 1</label><br>
                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                    <label for="vehicle2">Sector 2</label><br>
                    <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                    <label for="vehicle3">Sector 3</label>
                </div>
                <button type="submit"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>        
        </div>
    </div>

    <div class="basis-2/12">
        {{ $slot }}
    </div>    
</div>