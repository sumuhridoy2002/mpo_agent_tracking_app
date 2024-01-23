<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;

/**
 * Controller for handling not found routes
 * 
 * @author Hridoy
 */
class NotFoundController extends Controller
{
    use HttpResponse;

    /**
     * Handle the 404 response.
     *
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        try{
            return $this->sendError('Route not found.', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }
}