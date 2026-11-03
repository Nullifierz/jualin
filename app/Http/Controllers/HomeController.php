<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PlaceRecommendation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $places = PlaceRecommendation::with('categories')->get();

        $categories = Category::query()->get();
        
        return view('pages.frontend.home.index', [
            'places' => $places,
            'categories' => $categories
        ]);
    }
}
