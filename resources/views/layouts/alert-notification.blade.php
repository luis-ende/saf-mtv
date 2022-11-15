@if ($notification = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show flex flex-row" role="alert">
        <div class="text-base basis-10/12">
            @svg('clarity-success-standard-solid', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif


@if ($notification = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show flex flex-row" role="alert">
        <div class="text-base basis-10/12">
            @svg('uiw-warning', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

@if ($notification = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show flex flex-row" role="alert">
    <div class="text-base basis-10/12">
        @svg('uiw-warning', ['class' => 'h-5 w-5 inline-block mr-1'])
        {{ $notification }}
    </div>
    <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif

@if ($notification = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show flex flex-row" role="alert">
        <div class="text-base basis-10/12">
            @svg('bi-info-circle-fill', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif
