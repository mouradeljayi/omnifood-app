@extends('layouts.master')

@section('title', 'Toutes le vents')

@section('content')
<div class="container-fluid">
  @if ($message = Session::get('success'))
<div class="alert alert-success text-center">
  {{ $message }}
</div>
@endif
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-2">
                <h3 class="text-secondary">
                  <i class="fas fa-credit-card"></i> Les Ventes
                </h3>
                <a href="{{ route('payements.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
              </div>
              @if($sales->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">MENUS</th>
                    <th scope="col">TABLES</th>
                    <th scope="col">SERVEUR</th>
                    <th scope="col">QUANTITE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">TYPE PAIEMENT</th>
                    <th scope="col">ETAT PAIEMENT</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sales as $sale)
                  <tr>
                    <td>
                      @foreach($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                        <div class="col-md-4 mb-2">
                            <div class="h-100">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                   <img src="{{ asset("images/menus/". $menu->image) }}" alt="{{ $menu->title}}" class="img-fluid rounded-circle" width="50" height="50">
                                    <h5 class="font-weight-bold mt-2">
                                      {{ $menu->title }}
                                    </h5>
                                    <h5 class="text-muted">
                                      {{ $menu->price }} DH
                                   </h5>
                                </div>
                             </div>
                        </div>
                      @endforeach
                    </td>
                    <td>
                      @foreach($sale->tables()->where("sale_id",$sale->id)->get() as $table)
                        <div class="col-md-4 mb-2">
                            <div class="h-100">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                  <i class="fa fa-chair fa-3x"></i>
                                  <h5 class="text-muted mt-2">
                                   {{ $table->name }}
                                  </h5>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </td>
                    <td>
                      {{ $sale->servant->name}}
                    </td>
                    <td>
                      {{ $sale->quantity}}
                    </td>
                    <td>
                      {{ $sale->total_received}}
                    </td>
                    <td>
                      {{ $sale->payment_type === "cash" ? "Espéce" : "Carte bancaire"}}
                    </td>
                    <td>
                       {{ $sale->payment_status === "paid" ? "Payé" : "Impayé"}}
                    </td>
                    <td>
                      <div class="d-flex justify-content-start">
                        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('sales.destroy', $sale) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" name="button" class="btn btn-danger ml-2"><i class="fas fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
              <div class="alert alert-info mt-3">
                Il n'y a pas de vente pour le moment!
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $sales->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
