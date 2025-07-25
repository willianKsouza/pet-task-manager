<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Service\Dashboard\DashboardService;
use Illuminate\Http\Request;

class GetOverviewDataController extends Controller
{
    public function __construct(public DashboardService $dashboardService) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $this->dashboardService->execute();

        return response()->json($data);
    }
}
