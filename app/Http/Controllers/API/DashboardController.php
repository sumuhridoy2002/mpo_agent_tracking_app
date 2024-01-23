<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\DashboardDataResponseTrait;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller for handling Dashboard Data
 * 
 * @author Hridoy
 */
class DashboardController extends Controller
{
    use HttpResponse, DashboardDataResponseTrait;

    /**
     * Handle Dashboard Data.
     *
     * @return JsonResponse
     */
    public function get_dashboard_data() : JsonResponse
    {
        try{
            return $this->sendSuccess('Dashboard data fetched successfully.', $this->DashboardDataResponse());
        } catch (\Exception $e) {
            return $this->sendError('Internal Server Error. ' . $e->getMessage(), [], 500);
        }
    }
}