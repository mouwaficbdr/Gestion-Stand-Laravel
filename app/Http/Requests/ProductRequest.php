<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isApprovedEntrepreneur();
    }

    public function rules(): array
    {
        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'prix' => ['required', 'numeric', 'min:0'],
        ];
        if ($this->isMethod('post')) {
            $rules['photo'] = ['nullable', 'image', 'max:2048'];
        } else {
            $rules['photo'] = ['nullable', 'image', 'max:2048'];
        }
        return $rules;
    }
} 