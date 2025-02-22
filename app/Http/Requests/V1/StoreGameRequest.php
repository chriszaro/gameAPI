<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('game:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:2',
                'regex:/^[A-Za-z0-9 -:\'()!#]*$/'
            ],
            'description' => [
                'required',
                'string',
                'regex:/^[A-Za-z0-9 -:\'()!#]*$/'
            ],
            'releaseDate' => [
                'required',
                'string',
                'date_format:Y-m-d'
            ],
            'genre' => [
                'required',
                'string',
                'min:2',
                'regex:/^[A-Za-z]+([ -][A-Za-z]+)?$/'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'release_date' => $this->releaseDate
        ]);
    }


    public function messages()
    {
        return [
            'title.regex' => 'Title can only contain A-Z a-z 0-9 - : \' ( ) ! #',
            'description.regex' => 'Description can only contain A-Z a-z 0-9 - : \' ( ) ! #',
            'genre.regex' => 'Genre can contain only words or phrases of two words',
        ];
    }
}
