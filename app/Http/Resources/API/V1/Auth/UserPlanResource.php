<?php

namespace App\Http\Resources\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'slug' => $this->slug,
            'ends_at' => $this->ends_at,
            'starts_at' => $this->starts_at,
            'trial_ends_at' => $this->trial_ends_at,
            'active' => $this->active(),
            'usage' => $this->usage,
            'features' => $this->features,
        ];
    }
}
