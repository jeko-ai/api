<?php

namespace App\Http\Controllers\API\V1;

use F9Web\ApiResponseHelpers;
use OpenApi\Annotations as OA;

class GetNotificationsAction
{
    use ApiResponseHelpers;

    /**
     * @OA\Get(
     *     path="/v1/notifications",
     *     summary="Get user notifications",
     *     description="Retrieve a list of notifications grouped by type for the authenticated user.",
     *     tags={"Notifications"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "success": true,
     *                 "data": {
     *                     "news": {
     *                         {
     *                             "id": 1,
     *                             "type": "news",
     *                             "data": {"key": "value"},
     *                             "created_at": "2023-01-01T00:00:00.000000Z",
     *                             "read_at": null
     *                         }
     *                     }
     *                 }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             type="object",
     *             example={"message": "Unauthenticated."}
     *         )
     *     )
     * )
     */
    public function __invoke()
    {
        return $this->respondWithSuccess(auth()->user()->notifications->groupBy('type'));
    }
}

