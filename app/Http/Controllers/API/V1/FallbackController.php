<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class FallbackController
{
    /**
     * Handling all the routes that were not matched.
     *
     * @param  int $id
     * @return JsonResource
     */
    public function __invoke($id)
    {
        return response()->json([
            'message' => 'Page Not Found. If error persists, contact ' . env('MAIL_FROM_ADDRESS', 'support')], Response::HTTP_NOT_FOUND);
    }
}