@extends('template')

@section('title', __('messages.customers.edit'))

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.customers.edit') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">{{ __('messages.menus.customers') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.customers.edit') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('clientes.update',['cliente'=>$cliente]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">
                <!-- Tipo de persona -->
                <div class="col-md-6">
                    <label for="tipo_persona" class="form-label">{{ __('messages.forms.fields.client_type') }}</label>
                    <span class="fw-bold">{{ strtoupper($cliente->persona->tipo_persona) }}</span>
                </div>

                <!-- Razón Social -->
                <div class="col-md-6 mb-2" id="box-razon-social">
                    @if ( $cliente->persona->tipo_persona == 'natural')
                        <label id="label-natural" for="" class="form-label">{{ __('messages.forms.fields.full_name') }}</label>
                    @else
                        <label id="label-juridica" for="" class="form-label">{{ __('messages.forms.fields.company_name') }}</label>
                    @endif
                    <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social', $cliente->persona->razon_social)}}"/>
                    @error('razon_social')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="col-md-12 mb-2">
                    <label for="direccion" class="form-label">{{ __('messages.forms.fields.address') }}</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion', $cliente->persona->direccion)}}"/>
                    @error('direccion')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Tipo de persona -->
                <div class="col-md-6">
                    <label for="documento_id" class="form-label">{{ __('messages.forms.fields.document_type') }}</label>
                    <select
                        data-live-search="true" data-size="5"
                        title="{{ __('messages.forms.fields.option.select_one') }}"
                        class="form-control selectpicker show-tick"
                        name="documento_id" id="documento_id"
                    >
                        @foreach ($documentos as $item)
                            <option value="{{$item->id}}" {{
                                (old('documento_id') == $item->id || $cliente->persona->documento_id == $item->id )
                                    ? 'selected'
                                    : '' }}
                            >{{$item->abreviatura}} - {{$item->tipo_documento}}</option>
                        @endforeach
                    </select>
                    @error('tipo_persona')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- numero de documento -->
                <div class="col-md-6 mb-2">
                    <label for="numero_documento" class="form-label">{{ __('messages.forms.fields.number_id') }}</label>
                    <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento', $cliente->persona->numero_documento)}}"/>
                    @error('numero_documento')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">{{ __('messages.buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('js')
@endpush