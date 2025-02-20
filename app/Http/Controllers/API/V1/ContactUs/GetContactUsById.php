<?php

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Http\Resources\API\V1\ContactUsResource;
use App\Models\ContactUs;
use Illuminate\Routing\Controller;

/**
 * @OA\Get(
 *     path="/v1/contactus/{id}",
 *     summary="Get ContactUs by ID",
 *     tags={"ContactUs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful",
 *         @OA\JsonContent(ref="#/components/schemas/ContactUsResource")
 *     )
 * )
 */
class GetContactUsById extends Controller
{
    public function __invoke($id)
    {
        return new ContactUsResource(ContactUs::findOrFail($id));
    }
}
