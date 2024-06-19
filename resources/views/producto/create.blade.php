@extends('template')

@section('title', __('messages.products.create'))

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.products.create') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">{{ __('messages.menus.products') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.products.create') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <!-- codigo -->
                <div class="col-md-6 mb-2">
                    <label for="codigo" class="form-label">{{ __('messages.forms.fields.code') }}</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo')}}"/>
                    @error('codigo')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- nombre -->
                <div class="col-md-6 mb-2">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.name') }}</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}"/>
                    @error('nombre')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- descripcion -->
                <div class="col-md-12 mb-2">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.description') }}</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control textarea-fixed">{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- fecha de vencimiento -->
                <div class="col-md-6 mb-2">
                    <label for="fecha_vencimiento" class="form-label">{{ __('messages.forms.fields.expiry_date') }}</label>
                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento')}}"/>
                    @error('fecha_vencimiento')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="col-md-6 mb-2">
                    <label for="img_path" class="form-label">{{ __('messages.forms.fields.img_path') }}</label>
                    <input type="file" name="img_path" id="img_path" class="form-control" accept="Image" value="{{old('img_path')}}"/>
                    @error('img_path')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!--  Marca -->
                <div class="col-md-6 mb-2">
                    <label for="marca_id" class="form-label">{{ __('messages.forms.fields.brand') }}</label>
                    <select
                        data-live-search="true" data-size="5"
                        title="{{ __('messages.forms.fields.option.select_one') }}"
                        class="form-control selectpicker show-tick"
                        name="marca_id" id="marca_id"
                    >
                        @foreach ($marcas as $item)
                            <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                        @endforeach
                    </select>
                    @error('marca_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!--  Presentacion -->
                <div class="col-md-6 mb-2">
                    <label for="presentacione_id" class="form-label">{{ __('messages.forms.fields.presentation') }}</label>
                    <select
                        data-live-search="true"  data-size="5"
                        title="{{ __('messages.forms.fields.option.select_one') }}"
                        class="form-control selectpicker show-tick" 
                        name="presentacione_id" id="presentacione_id" 
                    >
                        @foreach ($presentaciones as $item)
                            <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                        @endforeach
                    </select>
                    @error('presentacione_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!--  Categoria -->
                <div class="col-md-6 mb-2">
                    <label for="categoria_id" class="form-label">{{ __('messages.forms.fields.categories') }}</label>
                    <select
                        data-live-search="true" data-size="5"
                        title="{{ __('messages.forms.fields.option.select_one') }}"
                        class="form-control selectpicker show-tick"
                        name="categorias[]" id="categorias" multiple
                    >
                        @foreach ($categorias as $item)
                            <option value="{{$item->id}}" {{ (in_array($item->id, old('categorias',[]))) ? 'selected' : ''}}>{{$item->caracteristica->nombre}}</option>
                        @endforeach
                    </select>
                    @error('categorias')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <!-- Botones -->
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
@endpush