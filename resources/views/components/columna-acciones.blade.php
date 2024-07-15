<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    @if($botonEdit == '1')
        <form action="{{route($ruta,[$key=>$value])}}" method="get">
            <button type="submit" class="btn btn-warning">{{ __('messages.buttons.edit') }}</button>
        </form>
    @endif
    @if($botonVer == '1')
        <button
            type="button"
            class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#viewModal-{{$value->id}}"
        >{{ __('messages.buttons.view') }}</button>
    @endif
    @if($estado == 1)
        <button
            type="button"
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#confirmModal-{{$value->id}}"
        >{{ __('messages.buttons.delete') }}</button>
    @else
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#confirmModal-{{$value->id}}"
        >{{ __('messages.buttons.restore') }}</button>
    @endif
</div>