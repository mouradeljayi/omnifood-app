<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Str;

class TablesController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  public function index()
  {
    $tables = Table::paginate(5);
    return view('manager.tables.index', ['tables' => $tables]);
  }

  public function create(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|unique:tables',
      'status' => 'required|boolean'
    ]);
    Table::create([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'status' => $request->status
    ]);

    return back()->with('success', 'La Table à été Ajoutée Avec Succés');
  }

  public function edit(Table $table)
  {
    $table = Table::findOrFail($table->id);
    return view('manager.tables.edit', compact('table'));
  }

  public function update(Request $request, Table $table)
  {
    $table->update([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'status' => $request->status
    ]);

    return redirect()->route('tables.index')->with('success', 'La Table à été Modifier Avec Succés');
  }

  public function destroy(Table $table)
  {
    $table = Table::findOrFail($table->id);
    $table->delete();
    return back()->with('success', 'La Table à été Supprimée Avec Succés');
  }

}
