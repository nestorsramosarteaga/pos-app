@extends('template')

@section('title', __('messages.categories.create'))

@push('css')

@endpush

    
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('messages.categories.create') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">{{ __('messages.menus.core') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">{{ __('messages.menus.categories') }}</a></li>
        <li class="breadcrumb-item active">{{ __('messages.categories.create') }}</li>
    </ol>

    <!-- Add Form -->
    <div class="container w-100 border border-2 border-primary rounded p-4 mt-3">
        <form action="{{ route('categorias.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.name') }}</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" />
                </div>
                <div class="col-md-12">
                    <label for="nombre" class="form-label">{{ __('messages.forms.fields.description') }}</label>
                    <textarea name="description" id="description" rows="3" class="form-control textarea-fixed"></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">{{ __('messages.buttons.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('js')

@endpush