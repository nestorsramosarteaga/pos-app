@if ( $estado == 1 )
    <span class="badge rounded-pill text-bg-success d-inline">{{ __('messages.status.active') }}</span>
@else
    <span class="badge rounded-pill text-bg-danger d-inline">{{ __('messages.status.deleted') }}</span>
@endif