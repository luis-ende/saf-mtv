@props(['mensajes' => []])

<div x-data="centroMensajes()"
     x-init="initCentroMensajes()"
     x-cloak
     class="flex flex-col">
    <div class="h-4/5">
        {{-- Título de la sección --}}
        <div class="flex flex-row text-mtv-primary font-bold items-center">
            @svg('uni-comment-exclamation-o', ['class' => 'hidden md:flex w-10 h-10 mr-5'])
            <span class="hidden md:flex 2xl:text-2xl xl:text-xl text-base">Centro de mensajes</span>

            {{-- Título visible sólo en versión responsiva --}}
            <div :class="{'flex flex-row justify-between items-center': $data.mensajesModalOpen, 'hidden': !$data.mensajesModalOpen}"
                 class="fixed top-0 left-0 bg-white right-0 border-b-2 hidden h-12 pt-1 pl-6">
                <span class="text-base">Centro de mensajes</span>
                <button @click="$data.mensajesModalOpen = !$data.mensajesModalOpen"
                        aria-label="Cerrar"
                        class="p-2 inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="h-5 w-5" :class="{'hidden': ! $data.mensajesModalOpen, 'inline-flex': $data.mensajesModalOpen }"
                         stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Total de mensajes --}}
        <div class="my-3">
            <span class="block text-mtv-text-gray font-bold">Total de mensajes: {{ count($mensajes) }}</span>
            <span x-show="items.length > 1"
                  class="block italic text-mtv-gray-2">
                Para conocer el detalle, revisa tu correo electrónico.
            </span>
        </div>

        {{-- Área de mensajes --}}
        <div class="h-96">
            <template x-for="(mensaje, index) in items" :key="index">
                <div x-show="checkView(index + 1)" class="mb-3">
                    <span class="block font-bold text-mtv-secondary" x-text="mensaje['user_name']"></span>
                    <span class="block text-mtv-text-gray" x-text="mensaje['subject']"></span>
                    <span class="block text-mtv-text-gray flex flex-row">
                        <span x-text="mensaje['fecha']"></span>
                        @svg('entypo-dot-single', ['class' => 'w-4 h-4 self-center mx-1'])
                        <span x-text="mensaje['hora']"></span>
                    </span>
                </div>
            </template>
        </div>
    </div>

    {{-- Barra de paginación --}}
    <div x-show="pages.length > 1"
         class="h-1/4 flex flex-row items-center justify-center text-mtv-gold font-bold">
        <div x-show="currentPage !== 1"
             class="px-2 py-1 cursor-pointer text-lg"
             @click="changePage(currentPage - 1)">
            <span><</span>
        </div>
        <template x-for="item in pages" :key="item">
            <div @click="changePage(item)"
                 class="px-3 py-2 cursor-pointer"
                 x-bind:class="{ 'bg-mtv-gold-light text-white': currentPage === item }">
                <span class="text-mtv-gold" x-text="item"
                      x-bind:class="{ 'text-white': currentPage === item }"></span>
            </div>
        </template>
        <div class="px-2 py-1 cursor-pointer text-lg"
             @click="changePage(currentPage + 1)">
            <span>></span>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function centroMensajes() {
            return {
                mensajes: @js($mensajes),
                items: [],
                view: 4,
                pages: [],
                offset: 5,
                pagination: {
                    total: 0,
                    lastPage: 0,
                    perPage: 5,
                    currentPage: 1,
                    from: 1,
                    to: 1 * 4
                },
                currentPage: 1,
                initCentroMensajes() {
                    this.pagination.total = this.mensajes.length;
                    this.pagination.lastPage = Math.ceil(this.mensajes.length / 4);
                    this.items = this.mensajes;

                    this.showPages()
                },
                changePage(page) {
                    if (page >= 1 && page <= this.pagination.lastPage) {
                        this.currentPage = page;
                        const total = this.items.length;
                        const lastPage = Math.ceil(total / this.view) || 1;
                        const from = (page - 1) * this.view + 1;
                        let to = page * this.view;
                        if (page === lastPage) {
                            to = total;
                        }
                        this.pagination.total = total;
                        this.pagination.lastPage = lastPage;
                        this.pagination.perPage = this.view;
                        this.pagination.currentPage = page;
                        this.pagination.from = from;
                        this.pagination.to = to;
                        this.showPages();
                    }
                },
                showPages() {
                    const pages = [];
                    let from = this.pagination.currentPage - Math.ceil(this.offset / 2);
                    if (from < 1) {
                        from = 1;
                    }
                    let to = from + this.offset - 1;
                    if (to > this.pagination.lastPage) {
                        to = this.pagination.lastPage;
                    }
                    while (from <= to) {
                        pages.push(from);
                        from++;
                    }
                    this.pages = pages;
                },
                checkView(index) {
                    return !(index > this.pagination.to || index < this.pagination.from);
                },
            }
        }
    </script>
@endpush