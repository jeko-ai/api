<?php

namespace App\Http\Controllers\API\V1\Auth\Subscriptions;

use F9Web\ApiResponseHelpers;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class CheckInvoiceAction
{
    use ApiResponseHelpers;

    /**
     * @throws ConnectionException
     */
    public function __invoke($id)
    {
        $apiUrl = config('services.fawaterk.api_url');

        $response = Http::asJson()
            ->acceptJson()
            ->withToken('Bearer ' . config('services.fawaterk.api_key'))->get("$apiUrl/api/v2/getInvoiceData/$id");

        $json = $response->json();

        if (isset($json['status']) && $json['status'] == 'success') {
            dd($json);
        }

        return $this->respondError('Invoice not found');
    }
}
