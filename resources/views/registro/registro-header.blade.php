<div class="flex flex-col flex-nowrap">
    <div class="py-3 bg-mtv-primary px-3 flex flex-row flex-nowrap font-bold md:text-base xs:text-sm">
        @php($currentRoute = Route::current()->getName())
        @php($esRegistroInicio = !in_array($currentRoute, ['registro-perfil-negocio.show', 'registro-contactos.show']))
        @if($esRegistroInicio)
            <a href="{{ route('homepage') }}"
               class="text-mtv-gold-light no-underline hover:text-white flex flex-row">
                @svg('fas-arrow-left', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block mr-3'])
                Inicio
            </a>
        @else
            <div class="md:basis-10/12 xs:basis-8/12 flex flex-row items-center">
                <div class="text-white">
                    @svg('fas-building', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block mr-2'])
                    Tu negocio
                </div>
                @svg('fas-arrow-right', ['class' => 'md:h-7 md:w-7 xs:h-5 inline-block text-white ml-5 mr-5 self-center'])
                <div class="{{ $currentRoute === 'registro-contactos.show' ? 'text-white' : 'text-mtv-gold-light' }}">
                    @svg('fas-building-user', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block mr-2'])
                    Contactos
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}"
                  class="md:basis-2/12 xs:basis-4/12 self-end text-mtv-gold-light no-underline hover:text-white text-end">
                @csrf
                <button
                   type="button"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    Cerrar sesión
                    @svg('fas-arrow-right', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block ml-3'])
                </button>
            </form>
        @endif
    </div>
    <div class="w-full h-3 bg-mtv-gold-light"></div>
    <div class="text-2xl py-1 px-7 bg-white border-b border-gray-200 flex flex-row my-3">
        <div class="{{ $esRegistroInicio ? 'basis-11/12' : 'basis-full' }}">
            <div class="font-bold text-2xl text-mtv-primary">{{ $titulo }}</div>
            <div class="xs:text-base md:text-lg tracking-wide text-mtv-text-gray">
                {{ $subtitulo }}
            </div>
        </div>
        @if($esRegistroInicio)
            <div class="basis-1/12 self-center flex flex-row justify-end">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                @svg('fluentui-chat-help-24-o', ['class' => 'md:h-7 md:w-7 xs:h-5 xs:w-5 inline-block text-mtv-primary'])
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="#">
                            {{ __('Tengo problemas con mi RFC') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
        @endif
    </div>
</div>
