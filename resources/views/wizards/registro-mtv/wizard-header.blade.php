{{--{{ dd($wizard['steps']) }}--}}
<div class="py-2">
    <h2>{{ $wizard['title'] }}</h2>
    @foreach($wizard['steps'] as $stepData)
        <span class="{{ $stepData['active'] ? 'text-primary fw-bold' : 'text-secondary' }}">
            {{ $loop->index + 1 . '. ' . $stepData['title'] }}->
        </span>
    @endforeach
</div>
