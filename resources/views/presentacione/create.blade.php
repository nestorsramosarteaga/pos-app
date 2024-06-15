@extends('template')

@section('title', __('messages.presentations.create'))

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.presentations.create') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('presentaciones.index') }}">{{ __('messages.menus.presentations') }}</a></li>
        <li class="breadcrumb-item active">{{ __('create') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('presentaciones.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.name') }}</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}"/>
                    @error('nombre')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.description') }}</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control textarea-fixed">{{old('descripcion')}}</textarea>
                    @error('descripcion')
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