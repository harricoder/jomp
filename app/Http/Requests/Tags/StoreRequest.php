<?php

declare(strict_types=1);

namespace App\Http\Requests\Tags;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name' => ['string', 'required', 'min:1', 'max:255', Rule::unique(Tag::class, 'name')],
        ];
    }
}
