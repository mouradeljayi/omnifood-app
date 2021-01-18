<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Str;

class MenuController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  public function index()
  {
    $menus = Menu::paginate(5);
    $categories = Category::all();
    return view('manager.menus.index', ['menus' => $menus, 'categories' => $categories]);
  }

  public function create(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|unique:menus',
      'description' => 'required',
      'image' => 'image|mimes:png,jpg,jpeg',
      'price' => 'required|numeric',
      'category_id' => 'required|numeric'

    ]);

    if($request->hasFile('image'))
    {
      $file = $request->image;
      $imageName = time() . "_" . $file->getClientOriginalName();
      $file->move(public_path('images/menus'), $imageName);
      Menu::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $imageName
      ]);
    }

    return back()->with('success', 'Le Menu à été Ajouté Avec Succés');
  }

  public function edit(Menu $menu)
  {
    $menu = Menu::findOrFail($menu->id);
    $categories = Category::all();
    return view('manager.menus.edit', compact('menu'), ['categories' => $categories]);
  }

  public function update(Request $request, Menu $menu)
  {
    if($request->hasFile('image'))
    {
      unlink(public_path('images/menus/' . $menu->image));
      $file = $request->image;
      $imageName = time() . "_" . $file->getClientOriginalName();
      $file->move(public_path('images/menus'), $imageName);
      $menu->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $imageName
      ]);
    }
    else {
      $menu->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
      ]);
    }

    return redirect()->route('menus.index')->with('success', 'Le Menu à été Modifié Avec Succés');
  }

  public function destroy(Menu $menu)
  {
    $menu = Menu::findOrFail($menu->id);
    unlink(public_path('images/menus/' . $menu->image));
    $menu->delete();
    return back()->with('success', 'Le Menu à été Supprimé Avec Succés');
  }
}
