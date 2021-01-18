@extends('layouts.master')

@section('title', 'Ventes')

@section('content')

<div class="container mb-3">

  @if(session()->has('success'))
	<div class="alert alert-success text-center">
	  {{ session('success')}}
	</div>
	@endif

  <form  action="{{ route("sales.create") }}" method="post">
    @csrf
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md my-2">
            <h3 class="text-muted border-bottom">{{ Carbon\Carbon::now() }} GMT</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <a href="{{ route("sales.index") }}" class="btn btn-primary float-right">Toutes les ventes</a>
            </div>
          </div>
          </div>
          <div class="card">
            @error('table_id')
                <div class="alert alert-danger text-center mt-2">{{ $message }}</div>
            @enderror
            <div class="card-body">
              <div class="row">
                @foreach($tables as $table)
                <div class="col-md-3">
                  <div class="card p-2 mb-2 d-flex flex-column justify-content-center align-items-center list-group-item-action">
                      <div class="align-self-end">
                        <input type="checkbox" name="table_id[]" id="table" value="{{ $table->id }}">
                      </div>
                      <i class="fas fa-chair fa-5x"></i>
                      <span class="mt-2 text-muted font-weight-bold">{{ $table->name }}</span>
                      <hr>
                      @foreach($table->sales as $sale)
                      @if($sale->created_at >= Carbon\Carbon::today())
                      <div style="border : dashed pink" class="mb-2 mt-2 shadow w-100" id="{{ $sale->id }}">
                        <div class="card-body p-3 d-flex flex-column justify-content-center align-items-center">
                          @foreach($sale->menus()->where("sale_id", $sale->id)->get() as $menu)
                          <h5 class="mt-2 font-weight-bold">{{ $menu->title }}</h5>
                          <span class="font-weight-bold">{{ $menu->price }} DH</span>
                          @endforeach
                          <span class="mt-2 badge badge-info">Quantité : {{ $sale->quantity }}</span>
                          <h5><span class="mt-2 badge badge-danger">TOTAL : {{ $sale->total_price }} DH</span></h5>
                          <span class="badge badge-light mt-2"> Prix reçu : {{ $sale->total_received }}</span>
                          <span class="badge badge-light mt-2"> Reste : {{ $sale->change }}</span>
                          <span class="badge badge-light mt-2">Type de Paiement : {{ $sale->payment_type === "cash" ? "Espèce" : "Carte" }}</span>
                          <span class="badge badge-light mt-2">Etat de Paiement : {{ $sale->payment_status === "paid" ? "Payé" : "Impayé" }}</span>
                          <span class="mt-2 badge badge-danger">Sérveur : {{ $sale->servant->name }}</span>
                          <div class=" p-3 d-flex flex-column justify-content-center align-items-center">
                            <img  src="{{ asset('images/omnifoodLogo.png') }}" class="mb-2" width="100px" alt="logo">
                            <span style="font-size: 12px;">Restaurant OMNIFOOD</span>
                            <span style="font-size: 12px;">Rue Farah -Marrakech</span>
                            <span style="font-size: 12px;">N°: +212655897124</span>
                          </div>
                        </div>
                      </div>
                      <div class="mt-2 d-flex justify-content-center align-items-center">
                        <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
                        <a href="#" target="_blank" class="btn btn-info ml-2" onclick="print({{ $sale->id }})"> <i class="fas fa-print"></i> </a>
                      </div>
                      @endif
                      @endforeach
                  </div>
                </div>
                @endforeach
              </div>
           </div>
      </div>
      <div class="row justify-content-center mt-2">
        <div class="col-md-12 card p-3">
          @error('menu_id')
              <div class="alert alert-danger text-center mt-2">{{ $message }}</div>
          @enderror
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach($categories as $category)
            <li class="nav-item">
              <a href="#{{ $category->slug }}" role="tab" aria-controls="{{ $category->slug }}" aria-selected="true" id="{{ $category->slug }}-tab" data-toggle="pill" class="nav-link mr-1 {{ $category->slug === "salades" ? "active" : "" }}">{{ $category->name }}</a>
            </li>
            @endforeach
          </ul>
          <div class="tab-content " id="pills-tabcontent">
            @foreach($categories as $category)
            <div class="tab-pane fade {{ $category->slug === "salades" ? "show active" : "" }}" id="{{ $category->slug }}" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="row">
                @foreach($category->menus as $menu )
                <div class="col-md-4 mb-2">
                  <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                      <div class="align-self-end">
                        <input type="checkbox" name="menu_id[]" id="menu_id" value="{{ $menu->id }}">
                      </div>
                      <img src="{{ asset('images/menus/' . $menu->image) }}"  class="img-fluid rounded-circle" width="100" height="100" alt="">
                      <h5 class="font-weight-bold mt-2">{{ $menu->title }}</h5>
                      <h5 class="text-muted">{{ $menu->price }} DH</h5>
                    </div>
                  </div>
                </div>
                @endforeach
                </div>
                </div>
               @endforeach
            </div>
              <div class="row">
                <div class="col-md-6 mx-auto">
                  <div class="form-group">
                    <select class="form-control @error('servant_id') is-invalid @enderror" name="servant_id">
                      <option value="" selected disabled>Sérveur</option>
                      @foreach($servants as $servant)
                      <option value="{{ $servant->id }}">{{ $servant->name }}</option>
                      @endforeach
                    </select>

                    @error('servant_id')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      Qté
                    </div>
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Tapez la quantité du menu">

                    @error('servant_id')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      DH
                    </div>
                    <input type="number" name="total_price" class="form-control @error('total_price') is-invalid @enderror" placeholder="Tapez le prix de menu">

                    @error('total_price')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      RECUS
                    </div>
                    <input type="number" name="total_received" class="form-control @error('total_received') is-invalid @enderror" placeholder="Tapez le total reçu de menu">

                    @error('total_received')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      RESTE
                    </div>
                    <input type="number" name="change" class="form-control @error('change') is-invalid @enderror" placeholder="Tapez le reste de menu">

                    @error('change')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <select class="form-control @error('payment_type') is-invalid @enderror" name="payment_type">
                      <option value="" selected disabled>Type de Paiement</option>
                      <option value="cash">Espèce</option>
                      <option value="card">Carte Bancaire</option>
                    </select>

                    @error('payment_type')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <select class="form-control @error('payment_status') is-invalid @enderror" name="payment_status">
                      <option value="" selected disabled>Etat de Paiement</option>
                      <option value="paid">Payé</option>
                      <option value="unpaid">Impayé</option>
                    </select>

                    @error('payment_status')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <button type="button" data-toggle="modal" data-target="#validerVente" class="btn btn-outline-success btn-block">Effecter la vente</button>
                  </div>
                  <!-- Modal -->
                    <div class="modal fade" id="validerVente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Valider une vente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h5>Êtes-vous sûr que vous voulez effectuer cette vente ?</h5>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger">Valider</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section("javascript")
    <script>
        function print(el){
            const page = document.body.innerHTML;
            const content = document.getElementById(el).innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = page;
        }
    </script>
@endsection
