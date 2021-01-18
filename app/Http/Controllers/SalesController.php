<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Menu;
use App\Models\Servant;


class SalesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $sales = Sale::latest()->paginate(5);
    return view('sales.index', ['sales' => $sales]);
  }


   public function create(Request $request)
   {
     $this->validate($request, [
            "table_id" => "required",
            "menu_id" => "required",
            "servant_id" => "required",
            "quantity" => "required|numeric",
            "total_price" => "required|numeric",
            "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
        ]);
        //store data
        $sale = new Sale();
        $sale->servant_id = $request->servant_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->total_price;
        $sale->total_received = $request->total_received;
        $sale->change = $request->change;
        $sale->payment_status = $request->payment_status;
        $sale->payment_type = $request->payment_type;
        $sale->save();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);
        //redirect user
        return redirect()->back()->with([
            "success" => "Paiement effectué avec succés"
        ]);
   }

   public function edit(Sale $sale)
   {
     $sale = Sale::findOrFail($sale->id);
     $tables = $sale->tables()->where('sale_id', $sale->id)->get();
     $menus = $sale->menus()->where('sale_id', $sale->id)->get();
     return view('sales.edit')->with([
       'tables' => $tables,
       'menus' => $menus,
       'sale' => $sale,
       'servants' => Servant::all()
     ]);
   }

   public function update(Sale $sale, Request $request)
   {
     $this->validate($request, [
            "table_id" => "required",
            "menu_id" => "required",
            "servant_id" => "required",
            "quantity" => "required|numeric",
            "total_price" => "required|numeric",
            "total_received" => "required|numeric",
            "change" => "required|numeric",
            "payment_type" => "required",
            "payment_status" => "required",
     ]);

     $sale->servant_id = $request->servant_id;
     $sale->quantity = $request->quantity;
     $sale->total_price = $request->total_price;
     $sale->total_received = $request->total_received;
     $sale->change = $request->change;
     $sale->payment_status = $request->payment_status;
     $sale->payment_type = $request->payment_type;
     $sale->update();
     $sale->menus()->sync($request->menu_id);
     $sale->tables()->sync($request->table_id);
     //redirect user
     return redirect()->route('payements.index')->with([
         "success" => "Paiement modifié avec succés"
     ]);
   }

   public function destroy(Sale $sale)
   {
     $sale = Sale::findOrFail($sale->id);
     $sale->delete();
     return back()->with('success', 'Le vente à été Supprimée Avec Succés');
   }
}
