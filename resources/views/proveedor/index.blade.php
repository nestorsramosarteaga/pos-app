@extends('template')

@section('title', __('messages.menus.suppliers'))

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.menus.suppliers') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.menus.suppliers') }}</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('proveedores.create') }}">
            <button type="button" class="btn btn-primary">{{ __('messages.buttons.add_new_record') }}</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('messages.customers.table') }}
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('messages.forms.fields.name') }}</th>
                        <th>{{ __('messages.forms.fields.address') }}</th>
                        <th>{{ __('messages.forms.fields.document') }}</th>
                        <th>{{ __('messages.forms.fields.client_type') }}</th>
                        <th>{{ __('messages.columns.status') }}</th>
                        <th>{{ __('messages.columns.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $item)
                        <tr>
                            <td>
                                {{ $item->persona->razon_social }}
                            </td>
                            <td>
                                {{ $item->persona->direccion }}
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{ $item->persona->documento->tipo_documento }}</p>
                                <p class="text-muted mb-0">{{ $item->persona->numero_documento}}</p>
                            </td>
                            <td>
                                {{ $item->persona->tipo_persona}}
                            </td>
                            <td>
                                <x-columna-estado :estado="$item->persona->estado" />
                            </td>
                            <td class="text-center">
                                <x-columna-acciones
                                    :ruta="'proveedores.edit'"
                                    :estado="$item->persona->estado"
                                    :key="'proveedore'"
                                    :value="$item"
                                />
                            </td>
                        </tr>

                        <!-- Confirm Modal -->
                        <x-confirm-modal
                            :id="$item->id"
                            :ruta="'proveedores.destroy'"
                            :estado="$item->persona->estado"
                            :key="'proveedore'"
                            :value="$item->persona_id"
                            :type="'supplier'"
                        />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush