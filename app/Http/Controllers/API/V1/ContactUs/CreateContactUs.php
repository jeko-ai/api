<?php

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Http\Requests\API\V1\ContactUs\CreateContactUsRequest;
use App\Http\Resources\API\V1\ContactUsResource;
use App\Models\ContactUs;
use Illuminate\Routing\Controller;

/**
 * @OA\Post(
 *     path="/v1/contactus",
 *     summary="Create a new ContactUs",
 *     tags={"ContactUs"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateContactUsRequest")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(ref="#/components/schemas/ContactUsResource")
 *     )
 * )
 */
class CreateContactUs extends Controller
{
    public function __invoke(CreateContactUsRequest $request)
    {
        $record = ContactUs::create($request->validated());
        return new ContactUsResource($record);
    }
}
