<?php

namespace App\Http\Requests\User;

use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\BaseApiRequest;

class GetOrDeleteUserRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['id' => "string"])]
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
        ];
    }
}
