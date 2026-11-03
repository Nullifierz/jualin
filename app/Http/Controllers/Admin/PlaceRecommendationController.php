<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PlaceRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceRecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placeRecommendations = PlaceRecommendation::with('categories')->latest()->get();
    
        return view('pages.admin.place-recommendations.index', [
            'placeRecommendations' => $placeRecommendations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.admin.place-recommendations.form', [
            'placeRecommendation' => new PlaceRecommendation(),
            'categories' => $categories,
            'page_meta' => [
                'title' => 'Tambah Tempat Rekomendasi',
                'route' => route('place-recommendation.store'),
                'method' => 'POST',
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id_category',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('place-images', 'public');
        }

        $placeRecommendation = new PlaceRecommendation();
        $placeRecommendation->fill($validatedData);
        $placeRecommendation->save();

        $placeRecommendation->categories()->attach($validatedData['categories']);

        return redirect()->route('place-recommendation.index')->with('success', 'Tempat Rekomendasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $placeRecommendation = PlaceRecommendation::with('categories')
        ->findOrFail($id);

        return view('pages.admin.place-recommendations.show', [
            'placeRecommendation' => $placeRecommendation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $placeRecommendation = PlaceRecommendation::findOrFail($id);

        $categories = Category::all();

        return view('pages.admin.place-recommendations.form', [
            'placeRecommendation' => $placeRecommendation,
            'categories' => $categories,
            'page_meta' => [
                'title' => 'Edit Tempat Rekomendasi',
                'route' => route('place-recommendation.update', $placeRecommendation->id_recommendation),
                'method' => 'PUT',
                'button_text' => 'Update'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id_category',
        ]);

        $placeRecommendation = PlaceRecommendation::findOrFail($id);
        
        if ($request->hasFile('image')) {
            if ($placeRecommendation->image) {
                Storage::disk('public')->delete($placeRecommendation->image);
            }
            $validatedData['image'] = $request->file('image')->store('place-images', 'public');
        } else {
            $validatedData['image'] = $placeRecommendation->image;
        }
        
        $placeRecommendation->fill($validatedData);
        $placeRecommendation->save();

        $placeRecommendation->categories()->sync($validatedData['categories']);

        return redirect()->route('place-recommendation.index')->with('success', 'Tempat Rekomendasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $placeRecommendation = PlaceRecommendation::findOrFail($id);
        
        if ($placeRecommendation->image) {
            Storage::disk('public')->delete($placeRecommendation->image);
        }
        
        $placeRecommendation->categories()->detach();
        $placeRecommendation->delete();

        return redirect()->route('place-recommendation.index')->with('success', 'Tempat Rekomendasi berhasil dihapus');
    }
}
