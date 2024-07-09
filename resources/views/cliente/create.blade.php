@extends('template')

@section('title', __('messages.customers.create'))

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<style>
    #box-razon-social{
        display: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.customers.create') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">{{ __('messages.menus.customers') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.customers.create') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('clientes.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <!-- Tipo de persona -->
                <div class="col-md-6">
                    <label for="tipo_persona" class="form-label">{{ __('messages.forms.fields.client_type') }}</label>
                    <select
                        data-live-search="true" data-size="2"
                        title="{{ __('messages.forms.fields.option.select_one') }}"
                        class="form-control selectpicker show-tick"
                        name="tipo_persona" id="tipo_persona"
                    >
                        <option value="natural" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>{{ __('messages.forms.fields.option.natural_person') }}</option>
                        <option value="juridica" {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>{{ __('messages.forms.fields.option.legal_person') }}</option>
                    </select>
                    @error('tipo_persona')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Razón Social -->
                <div class="col-md-6 mb-2" id="box-razon-social">
                    <label id="label-natural" for="" class="form-label">{{ __('messages.forms.fields.full_name') }}</label>
                    <label id="label-juridica" for="" class="form-label">{{ __('messages.forms.fields.company_name') }}</label>

                    <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social')}}"/>
                    @error('razon_social')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="col-md-12 mb-2">
                    <label for="direccion" class="form-label">{{ __('messages.forms.fields.address') }}</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}"/>
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
                            <option value="{{$item->id}}" {{ old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->abreviatura}} - {{$item->tipo_documento}}</option>
                        @endforeach
                    </select>
                    @error('tipo_persona')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- numero de documento -->
                <div class="col-md-6 mb-2">
                    <label for="numero_documento" class="form-label">{{ __('messages.forms.fields.number_id') }}</label>
                    <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento')}}"/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tipo_persona').on('change', function(){
            let selectValue = $(this).val();
            // natural or // juridica
            if(selectValue == 'natural') {
                $('#label-juridica').hide();
                $('#label-natural').show();
            }else{
                $('#label-natural').hide();
                $('#label-juridica').show();
            }

            $('#box-razon-social').show();
        });
    });
</script>
@endpush