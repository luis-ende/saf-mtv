@php($hasMessage = Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info') || (isset($errors) && $errors->any()))
@if($hasMessage)
<div class="flex flex-row justify-center">
@endif

@if ($notification = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show flex flex-row w-7/12 mt-3" role="alert">
        <div class="text-base basis-10/12">
            @svg('clarity-success-standard-solid', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif


@if ($notification = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show flex flex-row w-7/12 mt-3" role="alert">
        <div class="text-base basis-10/12">
            @svg('uiw-warning', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

@if ($notification = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show flex flex-row w-7/12 mt-3" role="alert">
    <div class="text-base basis-10/12">
        @svg('uiw-warning', ['class' => 'h-5 w-5 inline-block mr-1'])
        {{ $notification }}
    </div>
    <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif

@if ($notification = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show flex flex-row w-7/12 mt-3" role="alert">
        <div class="text-base basis-10/12">
            @svg('bi-info-circle-fill', ['class' => 'h-5 w-5 inline-block mr-1'])
            {{ $notification }}
        </div>
        <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show w-7/12 flex flex-col mt-3" role="alert">
        @foreach ($errors->all() as $error)
            <div class="text-base basis-full">
                @svg('uiw-warning', ['class' => 'h-5 w-5 inline-block mr-1'])
                {{ $error }}
            </div>
            <button type="button" class="btn-close basis-2/12 text-end" data-bs-dismiss="alert" aria-label="close"></button>
        @endforeach
    </div>
@endif

@if($hasMessage)
</div>
@endif

@if(Session::has('registro-completo'))
@php($dialogoHtml = Blade::render('layouts.registro-completo-alert'))
    <script>
        window.addEventListener("load", (event) => {
            showRegistroCompletoDialogo();
        });
        function showRegistroCompletoDialogo()
        {
            const props = SwalMTVCustom;
            props.customClass['title'] = 'swal2-mtv-title swal2-mtv-html-container-reg-completo'

            Swal.fire({
            ...props,
            cancelButtonText: 'Después',
            title: '¡Registro exitoso!',
            html: `{!! $dialogoHtml !!}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/catalogo-registro-inicio';
                }
            })
        }
    </script>
@endif
