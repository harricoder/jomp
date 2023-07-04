<?php

declare(strict_types=1);

namespace App\Http\Requests\Manufacturers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'min:1',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1024',
            ],
            'url' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
