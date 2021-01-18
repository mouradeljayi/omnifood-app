<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Table;
use App\Models\Servant;


class PayementController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('payements.index')->with([
        "tables" => Table::all(),
        "categories" => Category::all(),
        "servants" => Servant::all()
      ]);
    }
}
