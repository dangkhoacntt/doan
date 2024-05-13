<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revenue;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Revenue::query();

        if ($month && $year) {
            $query->whereMonth('date', $month)
                  ->whereYear('date', $year);
        } elseif ($month) {
            $query->whereMonth('date', $month);
        } elseif ($year) {
            $query->whereYear('date', $year);
        }

        $revenues = $query->get();

        return view('backend.revenue', compact('revenues'));
    }
}