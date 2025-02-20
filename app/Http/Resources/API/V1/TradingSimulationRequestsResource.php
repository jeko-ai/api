<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="TradingSimulationRequestsResource",
 *     @OA\Property(property="id", type="string", format="uuid")
 * )
 */
class TradingSimulationRequestsResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
