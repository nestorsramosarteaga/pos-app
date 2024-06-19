@extends('template')

@section('title', __('messages.menu.brands'))

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.menus.brands') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.menus.brands') }}</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('marcas.create') }}">
            <button type="button" class="btn btn-primary">{{ __('messages.buttons.add_new_record') }}</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('messages.brands.table') }}
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('messages.forms.fields.name') }}</th>
                        <th>{{ __('messages.forms.fields.description') }}</th>
                        <th>{{ __('messages.columns.status') }}</th>
                        <th>{{ __('messages.columns.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marcas as $marca)
                        <tr>
                            <td>
                                {{ $marca->caracteristica->nombre }}
                            </td>
                            <td>
                                {{ $marca->caracteristica->descripcion }}
                            </td>
                            <td>
                                <x-columna-estado :estado="$marca->caracteristica->estado" />
                            </td>
                            <td class="text-center">
                                <x-columna-acciones
                                    :ruta="'marcas.edit'"
                                    :estado="$marca->caracteristica->estado"
                                    :key="'marca'"
                                    :value="$marca"
                                />
                            </td>
                        </tr>

                        <!-- Confirm Modal -->
                        <x-confirm-modal
                            :ruta="'marcas.destroy'"
                            :estado="$marca->caracteristica->estado"
                            :key="'marca'"
                            :id="$marca->id"
                            :type="'brand'"
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