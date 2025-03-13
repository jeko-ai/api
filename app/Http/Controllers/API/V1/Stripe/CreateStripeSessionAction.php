<?php

namespace App\Http\Controllers\API\V1\Stripe;

use App\Http\Requests\CreateStripeSessionRequest;
use App\Models\Plans;
use Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CreateStripeSessionAction
{
    public function __invoke(CreateStripeSessionRequest $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $plan = Plans::find($request->plan_id);

        $plans = [
            "professional" => [
                "monthly" => '',
                "quarterly" => '',
                "biannual" => '',
                "yearly" => ''
            ],
            "standard" => [
                "monthly" => 'price_1R2BWuGWFg7qlxzI8Yisjqfd',
                "quarterly" => 'price_1R2CPjGWFg7qlxzIXQbeF1JA',
                "biannual" => 'price_1R2CQ9GWFg7qlxzINQBON8DB',
                "yearly" => 'price_1R2CQTGWFg7qlxzI3COqoHOd'
            ],
            "enterprise" => [
                "monthly" => '',
                "quarterly" => '',
                "biannual" => '',
                "yearly" => ''
            ],
        ];

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $plans[$plan->slug][$request->payment_option],
                        'quantity' => 1,
                    ],
                ],
                'success_url' => 'http://localhost:5000/subscription-success',
                'cancel_url' => 'http://localhost:5000/subscription-cancel',
            ]);

            return response()->json(['id' => $session->id]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
