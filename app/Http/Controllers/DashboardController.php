<?php

namespace App\Http\Controllers;
use App\Models\Office;
use App\Models\LetterType;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $previous_office_count = 2; // Office::where('created_at', '<', now()->subDays(1))->count(); // Get the previous office count
        $current_office_count = Office::count(); // Get the current office count
        $change = $previous_office_count > 0 ? (($current_office_count - $previous_office_count) / $previous_office_count * 100) : 0; // Calculate the percentage change
        
        return inertia('Dashboard', [
            "offices" => $this->officeInformation(),
            "letterTypes" => $this->letterTypeInformation(),
        ]);
    }

    private function officeInformation()
    {
        $previous_office_count = 2; // Office::where('created_at', '<', now()->subDays(1))->count(); // Get the previous office count
        $current_office_count = Office::count(); // Get the current office count
        $change = $previous_office_count > 0 ? (($current_office_count - $previous_office_count) / $previous_office_count * 100) : 0; // Calculate the percentage change

        return [
            "count" => $current_office_count,
            "change" => $change,
        ];
    }

    private function letterTypeInformation()
    {
        // Similar logic to officeInformation() but for letter types    
        $previous_letter_type_count = 5; // LetterType::where('created_at', '<', now()->subDays(1))->count(); // Get the previous letter type count
        $current_letter_type_count = LetterType::count(); // Get the current letter type count
        $change = $previous_letter_type_count > 0 ? (($current_letter_type_count - $previous_letter_type_count) / $previous_letter_type_count * 100) : 0; // Calculate the percentage change

        return [
            "count" => $current_letter_type_count,
            "change" => $change,
        ];
    }
}
