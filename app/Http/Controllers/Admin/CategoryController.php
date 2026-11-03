<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()
            ->latest()
            ->get();
        
        return view('pages.admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.categories.form', [
            'category' => new Category(),
            'page_meta' => [
                'title' => 'Tambah Kategori',
                'route' => route('category.store'),
                'method' => 'POST',
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($request->all());
        
        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id_category', $id)->first();

        return view('pages.admin.categories.form', [
            'category' => $category,
            'page_meta' => [
                'title' => 'Edit Kategori',
                'route' => route('category.update', $category->id_category),
                'method' => 'PUT',
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id . ',id_category',
        ]);

        $category = Category::where('id_category', $id)->first();
        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id_category', $id)->first();
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
