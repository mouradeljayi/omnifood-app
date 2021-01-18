<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servant;

class ServantsController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  public function index()
  {
    $servants = Servant::paginate(5);
    return view('manager.servants.index', ['servants' => $servants]);
  }

  public function create(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required',
    ]);
    Servant::create([
      'name' => $request->name,
      'address' => $request->address
    ]);

    return back()->with('success', 'Le Sérveur à été Ajouté Avec Succés');
  }

  public function edit(Servant $servant)
  {
    $servant = Servant::findOrFail($servant->id);
    return view('manager.servants.edit', compact('servant'));
  }

  public function update(Request $request, Servant $servant)
  {
    $servant->update([
      'name' => $request->name,
      'address' => $request->address
    ]);

    return redirect()->route('servants.index')->with('success', 'Le Sérveur à été Modifié Avec Succés');
  }

  public function destroy(Servant $servant)
  {
    $servant = Servant::findOrFail($servant->id);
    $servant->delete();
    return back()->with('success', 'Le Sérveur à été Supprimé Avec Succés');
  }
}
