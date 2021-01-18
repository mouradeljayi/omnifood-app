@extends('layouts.master')

@section('title', 'Rapports')

@section('content')
<div class="container mb-3">
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
                  <i class="fas fa-bars"></i> Les Rapports
                </h3>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 border border-success shadow mx-auto p-2">
                      <form action="{{ route('reports.generate') }}" method="post">
                        @csrf
                        <div class="form-group">
                          <input type="date" class="form-control" name="from" value="Tapez la date de début">
                        </div>
                        <div class="form-group">
                          <input type="date" class="form-control" name="to" value="Tapez la date de fin">
                        </div>
                        <button type="submit" name="button" class="btn btn-block btn-success">Générer un rapport</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @isset($total)
              <h4 class="text-primary font-weight-bold mt-4 mb-2">
                Rapport de {{ $startDate  }} à {{ $endDate }}
              </h4>
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">MENUS</th>
                    <th scope="col">TABLES</th>
                    <th scope="col">SERVEUR</th>
                    <th scope="col">QUANTITE</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">TYPE</th>
                    <th scope="col">ETAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sales as $sale)
                  <tr>
                    <td>
                 @foreach($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                    <div class="col-md-4 mb-2">
                      <div class="h-100">
                        <div class="d-flex flex-column justify-content-center align-items-center">
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
                      {{ $sale->total_received}} DH
                    </td>
                    <td>
                      {{ $sale->payment_type === "cash" ? "Espéce" : "Carte bancaire"}}
                    </td>
                    <td>
                     {{ $sale->payment_status === "paid" ? "Payé" : "Impayé"}}
                    </td>
                     </tr>
                    @endforeach
                </tbody>
              </table>
              <p class="text-danger text-center font-weight-bold">
                <span class="border border-danger p-2">
                   Total : {{ $total }} DH
                </span>
              </p>
              <form action="{{ route("reports.export") }}" method="post" class="text-center">
                @csrf
                <div class="form-group">
                  <input type="hidden" name="from" value="{{ $startDate }}" class="form-control">
                </div>
                <div class="form-group">
                  <input type="hidden" name="to" value="{{ $endDate }}" class="form-control">
                </div>
                <div class="form-group">
                  <button class="btn btn-danger">
                   Génerer le rapport excel
                  </button>
                </div>
              </form>
              @endisset
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
