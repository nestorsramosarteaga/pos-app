@extends('template')

@section('title','messages.products')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.menus.products') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.menus.products') }}</li>
    </ol>

    <div class="mb-4">
        <a href="{{ route('productos.create') }}">
            <button type="button" class="btn btn-primary">{{ __('messages.buttons.add_new_record') }}</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ __('messages.products.table') }}
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('messages.forms.fields.code') }}</th>
                        <th>{{ __('messages.forms.fields.name') }}</th>
                        <th>{{ __('messages.forms.fields.brand') }}</th>
                        <th>{{ __('messages.forms.fields.presentation') }}</th>
                        <th>{{ __('messages.forms.fields.categories') }}</th>
                        <th>{{ __('messages.columns.status') }}</th>
                        <th>{{ __('messages.columns.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $item)
                    <tr>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->marca->caracteristica->nombre }}</td>
                        <td>{{ $item->presentacione->caracteristica->nombre }}</td>
                        <td>
                            @foreach ($item->categorias as $categoria)
                                <div class="container">
                                    <div class="row">
                                        <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">
                                            {{ $categoria->caracteristica->nombre }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <x-columna-estado :estado="$item->estado" />
                        </td>
                        <td>
                            <x-columna-acciones
                                :ruta="'productos.edit'"
                                :estado="$item->estado"
                                :key="'producto'"
                                :value="$item"
                                :botonVer="'1'"
                            />

                        </td>
                    </tr>

                    <!-- View Modal-->
                    <div class="modal fade" id="viewModal-{{$item->id}}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="viewModalLabel">{{ __('messages.modals.title_product_details') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <label><span class="fw-bolder">{{ __('messages.forms.fields.description') }}: </span>{{$item->descripcion}}</label>
                                </div>
                                <div class="row mb-3">
                                    <label><span class="fw-bolder">{{ __('messages.forms.fields.expiry_date') }}: </span>{{$item->fecha_vencimiento ?? __('messages.forms.fields.none')}}</label>
                                </div>
                                <div class="row mb-3">
                                    <label><span class="fw-bolder">{{ __('messages.forms.fields.stock') }}: </span>{{$item->stock}}</label>
                                </div>
                                <div class="row mb-3">
                                    <label class="fw-bolder">
                                        {{ __('messages.forms.fields.img_path') }}
                                    </label>
                                    <div>
                                        @if ($item->img_path != null)
                                            <img
                                                class="img-fluid img-thumbnail border border-4 rounded"
                                                src="{{ Storage::url('productos/'.$item->img_path) }}" 
                                                alt="{{ $item->nombre }}" />
                                        @else
                                            <img src="" alt="{{ $item->nombre }}" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Modal -->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="confirmModalLabel">{{ __('messages.modals.confirmation_message') }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $item->estado == 1 ? __('messages.modals.confirmation_message_delete_product') : __('messages.modals.confirmation_message_restore_product') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.buttons.close') }}</button>

                                <form action="{{ route('productos.destroy',['producto'=>$item->id]) }}" method="post">
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