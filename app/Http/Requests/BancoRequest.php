<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BancoRequest extends FormRequest
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
			'nombre' => 'required|string',
			'tipo_cuenta' => 'required',
			'numero_cuenta' => 'required|string',
			'moneda' => 'required',
            'cuenta_banco' => 'required|string|size:4',
        ];
    }
}
