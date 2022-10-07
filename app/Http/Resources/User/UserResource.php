<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape([
        'id' => "int",
        'first_name' => "string",
        'last_name' => "string",
        'vehicle' => VehicleResource::class,
        'created_at' => "\Illuminate\Support\Carbon|null",
        'updated_at' => "\Illuminate\Support\Carbon|null"
    ])] public function toArray($request): array
    {
        /** @var User | UserResource $this */
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'vehicle' => VehicleResource::make($this->whenLoaded('vehicle')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
