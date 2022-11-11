<x-guest-layout>
    @include('wizards.registro-mtv.wizard-header')

    <x-producto-form
        :mode="__('wizard')"
        :wizard="$wizard" />
</x-guest-layout>
