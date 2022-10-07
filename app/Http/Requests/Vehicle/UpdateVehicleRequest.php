<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\BaseApiRequest;

class UpdateVehicleRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'id' => "string",
        'name' => "string",
        'vin' => "array",
        'user_id' => "string"
    ])] public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|between:2,255',
            'user_id' => 'present|nullable|integer|exists:users,id',
            'vin' => [
                'required',
                'between:2,255',
                Rule::unique('vehicles')->ignore($this->validationData()['id']),
            ],
        ];
    }
}
