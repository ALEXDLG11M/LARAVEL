<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255'],
			'body'  => ['required','string','min:10'],
        ];
    }

	public function messages(): array
	{
		return [
			'title.required' => 'El título es obligatorio.',
	        'title.max'      => 'El título no debe exceder 255 caracteres.',
	    	'body.required'  => 'El contenido es obligatorio.',
			'body.min'       => 'El contenido debe tener al menos 10 caracteres.',
	    ];
	}
}
