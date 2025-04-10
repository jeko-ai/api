<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'features' => $this->features,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'trial_ends_at' =>  $this->trial_ends_at,
            'starts_at' =>  $this->starts_at,
            'ends_at'   =>  $this->ends_at,
            'cancels_at'    =>  $this->cancels_at,
            'canceled_at'   =>  $this->canceled_at,
            'active'   =>  $this->active(),
            'on_trial'   =>  $this->onTrial(),
            'canceled'   =>  $this->canceled(),
            'ended'   =>  $this->ended(),
        ];
    }
}
