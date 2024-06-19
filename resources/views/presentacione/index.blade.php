@extends('template')

@section('title', __('messages.menus.presentations'))

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.menus.presentations') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.menus.presentations') }}</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('presentaciones.create') }}">
            <button type="button" class="btn btn-primary">{{ __('messages.buttons.add_new_record') }}</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('messages.presentations.table') }}
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
                    @foreach($presentaciones as $presentacione)
                        <tr>
                            <td>
                                {{ $presentacione->caracteristica->nombre }}
                            </td>
                            <td>
                                {{ $presentacione->caracteristica->descripcion }}
                            </td>
                            <td>
                                <x-columna-estado :estado="$presentacione->caracteristica->estado" />
                            </td>
                            <td class="text-center">
                                <x-columna-acciones
                                    :ruta="'presentaciones.edit'"
                                    :estado="$presentacione->caracteristica->estado"
                                    :key="'presentacione'"
                                    :value="$presentacione"
                                />
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$presentacione->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="confirmModalLabel">{{ __('messages.modals.confirmation_message') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $presentacione->caracteristica->estado == 1 ? __('messages.modals.confirmation_message_delete_presentation') : __('messages.modals.confirmation_message_restore_presentation') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.buttons.close') }}</button>

                                    <form action="{{ route('presentaciones.destroy',['presentacione'=>$presentacione->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">{{ __('messages.buttons.confirm') }}</button>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>
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