<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('game:update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
//        $method = $this->method();
//
//        if ($method === 'PUT') {
//            return [
//                'title' => ['required', 'string'],
//                'description' => ['required', 'string'],
//                'releaseDate' => ['required', 'string'],
//                'genre' => ['required', 'string'],
//            ];
//        } else {
        return [
            'title' => ['sometimes', 'required', 'string'],
            'description' => ['sometimes', 'required', 'string'],
            'releaseDate' => ['sometimes', 'required', 'string'],
            'genre' => ['sometimes', 'required', 'string'],
        ];
//        }


    }

    protected function prepareForValidation()
    {
        if ($this->releaseDate) {
            $this->merge([
                'release_date' => $this->releaseDate
            ]);
        }
    }
}
