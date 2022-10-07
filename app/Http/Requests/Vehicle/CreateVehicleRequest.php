<?php

namespace App\Http\Requests\Vehicle;

use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\BaseApiRequest;

class CreateVehicleRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string", 'vin' => "string", 'user_id' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|between:2,255',
            'vin' => 'required|between:2,255|unique:vehicles,vin',
            'user_id' => 'present|nullable|integer|exists:users,id',
        ];
    }
}
