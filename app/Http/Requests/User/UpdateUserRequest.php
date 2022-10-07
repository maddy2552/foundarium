<?php

namespace App\Http\Requests\User;

use JetBrains\PhpStorm\ArrayShape;

class UpdateUserRequest extends CreateUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['id' => "string", 1 => "mixed[]|string[]"])]
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            ...parent::rules(),
        ];
    }
}
