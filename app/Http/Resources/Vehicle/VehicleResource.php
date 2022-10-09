<?php

namespace App\Http\Resources\Vehicle;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape([
        'id' => "int|mixed",
        'name' => "mixed|string",
        'vin' => "mixed|string",
        'user' => UserResource::class,
        'created_at' => "\Illuminate\Support\Carbon|null",
        'updated_at' => "\Illuminate\Support\Carbon|null"
    ])] public function toArray($request): array
    {
        /** @var Vehicle | VehicleResource $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'vin' => $this->vin,
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
