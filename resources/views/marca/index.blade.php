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
                                @if ( $marca->caracteristica->estado == 1 )
                                    <span class="fw-bolder p-1 rounded bg-success text-white">{{ __('messages.status.active') }}</span>
                                @else
                                    <span class="fw-bolder p-1 rounded bg-danger text-white">{{ __('messages.status.deleted') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('marcas.edit',['marca'=>$marca])}}" method="get">
                                        <button type="submit" class="btn btn-warning">{{ __('messages.buttons.edit') }}</button>
                                    </form>
                                    @if($marca->caracteristica->estado == 1)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$marca->id}}">{{ __('messages.buttons.delete') }}</button>
                                    @else
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$marca->id}}">{{ __('messages.buttons.restore') }}</button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal-{{$marca->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="confirmModalLabel">{{ __('messages.modals.confirmation_message') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $marca->caracteristica->estado == 1 ? __('messages.modals.confirmation_message_delete_brand') : __('messages.modals.confirmation_message_restore_brand') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.buttons.close') }}</button>

                                    <form action="{{ route('marcas.destroy',['marca'=>$marca->id]) }}" method="post">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        let message = "{{ session('success') }}"
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: message
        });
    </script>
    @endif

@endpush