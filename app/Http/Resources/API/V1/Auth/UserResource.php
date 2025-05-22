<?php

namespace App\Http\Resources\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'language' => $this->language,
            'risk_level' => $this->risk_level,
            'trading_style' => $this->trading_style,
            'country_id' => $this->country_id,
            'is_notification_enabled' => $this->is_notification_enabled,
            'is_price_alerts_enabled' => $this->is_price_alerts_enabled,
            'is_new_recommendations_alerts_enabled' => $this->is_new_recommendations_alerts_enabled,
            'is_portfolio_update_alerts_enabled' => $this->is_portfolio_update_alerts_enabled,
            'is_market_sentiment_alerts_enabled' => $this->is_market_sentiment_alerts_enabled,
            'plan' => UserPlanResource::make($this->activePlanSubscriptions()->first()),
            'sectors' => $this->whenLoaded('sectors', $this->sectors),
        ];
    }
}
