<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="MarketMostVolatileResource",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class MarketMostVolatileResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
