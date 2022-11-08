{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <x-descripcion-negocio-form
        :mode="__('wizard')"
        :wizard="$wizard"
        :step="$step" />
</x-guest-layout>
