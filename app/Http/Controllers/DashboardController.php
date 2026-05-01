<?php

namespace App\Http\Controllers;
use App\Models\Office;
use App\Models\Topic;
use Artisan;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Artisan::call('inspire');

        $output = Artisan::output();
        return inertia('Dashboard', [
            "offices" => $this->dashboardInformation(Office::class),
            "topics" => $this->dashboardInformation(Topic::class),
            "inspire" => $output
        ]);
    }

    private function dashboardInformation($model)
    {
        $previous_count = $model::where('created_at', '<', now()->subDays(1))->count(); // Get the previous count
        $current_count = $model::count(); // Get the current count
        $change = $previous_count > 0 ? (($current_count - $previous_count) / $previous_count * 100) : 0; // Calculate the percentage change

        return [
            "count" => $current_count,
            "change" => round($change, 2),
        ];
    }

}
