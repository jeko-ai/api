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
     *     description="Retrieve a list of notifications grouped by type for the authenticated user. Optionally filter by type using the 'type' query parameter.",
     *     tags={"Notifications"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter notifications by type",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "success": true,
     *                 "data": {
     *                     "news": [
     *                         {
     *                             "id": 1,
     *                             "type": "news",
     *                             "data": {
     *                                 "title": "Breaking News",
     *                                 "content": "Details about the breaking news."
     *                             },
     *                             "created_at": "2023-01-01T00:00:00.000000Z",
     *                             "read_at": null
     *                         }
     *                     ],
     *                     "alerts": [
     *                         {
     *                             "id": 2,
     *                             "type": "alert",
     *                             "data": {
     *                                 "message": "System maintenance scheduled.",
     *                                 "time": "2023-01-02T12:00:00.000000Z"
     *                             },
     *                             "created_at": "2023-01-01T10:00:00.000000Z",
     *                             "read_at": "2023-01-01T12:00:00.000000Z"
     *                         }
     *                     ]
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
        $user = auth()->user();
        $type = request('type');

        $notifications = $type
            ? $user->notifications->where('type', $type)
            : $user->notifications;

        return $this->respondWithSuccess($notifications);
    }
}

