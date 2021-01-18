<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
      return $this->middleware('auth');
    }

    public function index()
    {
      $categories = Category::paginate(5);
      return view('manager.categories.index', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:categories',
      ]);
      Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
      ]);

      return back()->with('success', 'La Catégorie à été Ajoutée Avec Succés');
    }

    public function edit(Category $category)
    {
      $category = Category::findOrFail($category->id);
      return view('manager.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
      $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
      ]);

      return redirect()->route('categories.index')->with('success', 'La Catégorie à été Modifier Avec Succés');
    }

    public function destroy(Category $category)
    {
      $category = Category::findOrFail($category->id);
      $category->delete();
      return back()->with('success', 'La Catégorie à été Supprimée Avec Succés');
    }


}
