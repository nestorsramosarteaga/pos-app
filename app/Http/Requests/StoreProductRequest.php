<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => 'required|unique:productos,codigo|max:50',
            'nombre' => 'required|unique:productos,nombre|max:80',
            'descripcion' => 'nullable|max:255',
            'img_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'fecha_vencimiento' => 'nullable|date',
            'marca_id' => 'required|integer|exists:marcas,id',
            'presentacione_id' => 'required|integer|exists:presentaciones,id',
            'categorias' =>  'required'
        ];
    }

    public function attributes() : array
    {
        return [
            'codigo' => __('messages.forms.fields.code'),
            'nombre' => __('messages.forms.fields.name'),
            'descripcion' => __('messages.forms.fields.description'),
            'img_path' => __('messages.forms.fields.img_path'),
            'fecha_vencimiento' => __('messages.forms.fields.expiry_date'),
            'marca_id' => __('messages.forms.fields.brand'),
            'presentacione_id'=> __('messages.forms.fields.presentation'),
            'categorias' => __('messages.forms.fields.categories'),
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => __('messages.forms.fields.required.code')
        ];
    }
}
