<x-app-layout>
    @include('wizards.registro-mtv.wizard-header')

    <x-perfil-negocio-form
        :mode="__('wizard')"
        :wizard="$wizard"
        :step="$step" />
</x-app-layout>
