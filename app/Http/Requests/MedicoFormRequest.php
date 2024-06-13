<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|max:255',
            'especialidad' => 'required|max:255',
            'aniosservicio' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ajustar según tus necesidades
        ];
    }
}
