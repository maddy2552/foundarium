<?php

namespace App\Http\Requests\User;

use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\BaseApiRequest;

class CreateUserRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['first_name' => "string", 'last_name' => "string", 'vehicle_id' => "string"])]
    public function rules(): array
    {
        return [
            'first_name' => 'required|between:2,255',
            'last_name' => 'required|between:2,255',
            'vehicle_id' => 'present|nullable|integer|exists:vehicles,id',
        ];
    }
}
