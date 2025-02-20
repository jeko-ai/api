<?php

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Http\Requests\API\V1\ContactUs\UpdateContactUsRequest;
use App\Http\Resources\API\V1\ContactUsResource;
use App\Models\ContactUs;
use Illuminate\Routing\Controller;

/**
 * @OA\Put(
 *     path="/api/v1/contactus/{id}",
 *     summary="Update ContactUs",
 *     tags={"ContactUs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UpdateContactUsRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated",
 *         @OA\JsonContent(ref="#/components/schemas/ContactUsResource")
 *     )
 * )
 */
class UpdateContactUs extends Controller
{
    public function __invoke(UpdateContactUsRequest $request, $id)
    {
        $record = ContactUs::findOrFail($id);
        $record->update($request->validated());
        return new ContactUsResource($record);
    }
}
