<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\SubscribeRequest;
use App\Models\Plan;
use Illuminate\Support\Facades\Http;

class SubscribeAction
{
    public function __invoke(SubscribeRequest $request)
    {
        $plan = Plan::find($request->plan_id);
        $user = $request->user();

        $discount = match ($request->payment_option) {
            'quarterly' => 10,
            'biannual' => 20,
            'yearly' => 30,
            default => 0,
        };

        $multiplier = match ($request->payment_option) {
            'monthly' => 1,
            'quarterly' => 3,
            'biannual' => 6,
            'yearly' => 12,
        };
        $cartTotal = $plan->price * $multiplier;
        $cartTotal -= ($cartTotal * $discount) / 100;
        $response = Http::asJson()
            ->acceptJson()
            ->post('https://staging.fawaterk.com/api/v2/createInvoiceLink', [
                'cartTotal' => $cartTotal,
                'currency' => 'USD',
                'customer' => [
                    'first_name' => $user->name,
                    'last_name' => '',
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => '',
                ],
                'redirectionUrls' => [
                    'successUrl' => 'https://kira.ws/payment-success',
                    'failUrl' => 'https://kira.ws/payment-fail',
                    'pendingUrl' => 'https://kira.ws/payment-pending',
                ],
                'cartItems' => [
                    [
                        'name' => $plan->name . ' Plan * ' . $request->payment_option,
                        'price' => $cartTotal,
                        'quantity' => '1',
                    ],
                ],
                'payLoad' => [
                    'plan_id' => $plan->id,
                    'payment_option' => $request->payment_option,
                    'discount' => $discount,
                ]
            ]);

        echo $response->json();

    }
}
