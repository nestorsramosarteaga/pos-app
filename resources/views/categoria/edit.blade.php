@extends('template')

@section('title','messages.categories.edit')

@push('css')

@endpush


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.categories.edit') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">{{ __('messages.menus.categories') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.categories.edit') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        <form action="{{ route('categorias.update',['categoria'=>$categoria]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.name') }}</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $categoria->caracteristica->nombre)}}"/>
                    @error('nombre')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.description') }}</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control textarea-fixed">{{old('descripcion', $categoria->caracteristica->descripcion)}}</textarea>
                    @error('descripcion')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary me-2" type="submit">{{ __('messages.buttons.update') }}</button>
                    <button class="btn btn-secondary" type="reset">{{ __('messages.buttons.reset') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('js')

@endpush