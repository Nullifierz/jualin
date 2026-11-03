<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PlaceRecommendation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $places = PlaceRecommendation::query()->get();
        $categories = Category::query()->get();
         
        return view('pages.admin.dashboard.index', [
            'places' => $places,
            'categories' => $categories
        ]);
    }
}
