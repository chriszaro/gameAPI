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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'releaseDate' => ['required', 'string'],
            'genre' => ['required', 'string'],
            'user_id' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'release_date' => $this->releaseDate
        ]);
    }
}
