@if ( $estado == 1 )
    <span class="fw-bolder p-1 rounded bg-success text-white">{{ __('messages.status.active') }}</span>
@else
    <span class="fw-bolder p-1 rounded bg-danger text-white">{{ __('messages.status.deleted') }}</span>
@endif