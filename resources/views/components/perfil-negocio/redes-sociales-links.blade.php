@props([
    'svg_attributes' => [],
    'links' => []
])

<div class="px-3 pb-1 bg-gray-50 rounded">
    <label class="text-mtv-gray-2 mb-2">Sitio web y redes sociales</label>
    <div class="flex flex-row flex-nowrap justify-between mb-3 text-mtv-gold cursor-pointer border-t-2 pt-3">
        @php($svgParams = ['class' => 'h-5 w-5 hover:text-mtv-primary'])

        @php($svgWeb = array_merge($svgParams, $svg_attributes['sitio_web'] ?? []))
        @php($svgFb = array_merge($svgParams, $svg_attributes['cuenta_facebook'] ?? []))
        @php($svgTw = array_merge($svgParams, $svg_attributes['cuenta_twitter'] ?? []))
        @php($svgLn = array_merge($svgParams, $svg_attributes['cuenta_linkedin'] ?? []))
        @php($svgWh = array_merge($svgParams, $svg_attributes['num_whatsapp'] ?? []))

        @isset($links['sitio_web'])
        <a class="mtv-link-gold" href="{{ $links['sitio_web'] }}" target="_blank">
        @endisset
            @svg('iconoir-internet', $svgWeb)
        @isset($links['sitio_web'])
        </a>
        @endisset

        @isset($links['cuenta_facebook'])
            <a class="mtv-link-gold" href="{{ $links['cuenta_facebook'] }}" target="_blank">
        @endisset
            @svg('entypo-facebook', $svgFb)
        @isset($links['cuenta_facebook'])
            </a>
        @endisset

        @isset($links['cuenta_twitter'])
            <a class="mtv-link-gold" href="{{ $links['cuenta_twitter'] }}" target="_blank">
        @endisset
            @svg('fab-twitter-square', $svgTw)
        @isset($links['cuenta_twitter'])
            </a>
        @endisset

        @isset($links['cuenta_linkedin'])
            <a class="mtv-link-gold" href="{{ $links['cuenta_linkedin'] }}" target="_blank">
        @endisset
            @svg('uiw-linkedin', $svgLn)
        @isset($links['cuenta_linkedin'])
            </a>
        @endisset

        @isset($links['num_whatsapp'])
            <a class="mtv-link-gold" href="{{ $links['num_whatsapp'] }}" target="_blank">
        @endisset
            @svg('icomoon-whatsapp', $svgWh)
        @isset($links['num_whatsapp'])
            </a>
        @endisset
    </div>
</div>
