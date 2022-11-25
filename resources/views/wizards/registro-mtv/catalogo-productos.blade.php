<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @include('wizards.registro-mtv.wizard-header')

            <div class="px-6">
                <x-producto-form
                    :mode="__('wizard')"
                    :wizard="$wizard" />
            </div>
        </div>
    </div>
</x-app-layout>
