@extends('template')

@section('title', __('messages.menus.categories'))

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.menus.categories') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.menus.categories') }}</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('categorias.create') }}">
            <button type="button" class="btn btn-primary">{{ __('messages.buttons.add_new_record') }}</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('messages.categories.table') }}
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
                    @foreach($categorias as $item)
                        <tr>
                            <td>
                                {{ $item->caracteristica->nombre }}
                            </td>
                            <td>
                                {{ $item->caracteristica->descripcion }}
                            </td>
                            <td>
                                <x-columna-estado :estado="$item->caracteristica->estado" />
                            </td>
                            <td class="text-center">
                                <x-columna-acciones
                                    :ruta="'categorias.edit'"
                                    :estado="$item->caracteristica->estado"
                                    :key="'categoria'"
                                    :value="$item"
                                />
                            </td>
                        </tr>

                        <!-- Confirm Modal -->
                        <x-confirm-modal
                            :ruta="'categorias.destroy'"
                            :estado="$item->caracteristica->estado"
                            :key="'categoria'"
                            :id="$item->id"
                            :value="$item->id"
                            :type="'category'"
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