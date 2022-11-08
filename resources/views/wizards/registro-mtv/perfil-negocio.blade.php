{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <x-perfil-negocio-form
        :mode="__('wizard')"
        :wizard="$wizard"
        :step="$step" />
</x-guest-layout>
