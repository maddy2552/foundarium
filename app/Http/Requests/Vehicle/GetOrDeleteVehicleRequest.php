<?php

namespace App\Http\Requests\Vehicle;

use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\BaseApiRequest;

class GetOrDeleteVehicleRequest extends BaseApiRequest
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
