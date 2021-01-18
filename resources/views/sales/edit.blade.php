@extends('layouts.master')

@section('title', 'Modifier Vente')

@section('content')

<div class="container mb-3">
  <form  action="{{ route("sales.update", $sale) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <a href="{{ route('payements.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
          </div>
        </div>
        <div class="text-left pb-2">
          <h4 class="text-warning"> <i class="fas fa-edit"></i> Modifier une vente</h4>
        </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach($tables as $table)
                <div class="col-md-3">
                  <div class="card p-2 mb-2 d-flex flex-column justify-content-center align-items-center list-group-item-action">
                      <div class="align-self-end">
                        <input type="checkbox" name="table_id[]" id="table" checked value="{{ $table->id }}">
                      </div>
                      <i class="fas fa-chair fa-5x"></i>
                      <span class="mt-2 text-muted font-weight-bold">{{ $table->name }}</span>
                      <hr>
                  </div>
                </div>
                @endforeach
              </div>
           </div>
      </div>
      <div class="row justify-content-center mt-2">
        <div class="col-md-12 card p-3">
            <div class="row">
                @foreach($menus as $menu )
                <div class="col-md-4 mb-2">
                  <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                      <div class="align-self-end">
                        <input type="checkbox" checked name="menu_id[]" id="menu_id" value="{{ $menu->id }}">
                      </div>
                      <img src="{{ asset('images/menus/' . $menu->image) }}"  class="img-fluid rounded-circle" width="100" height="100" alt="">
                      <h5 class="font-weight-bold mt-2">{{ $menu->title }}</h5>
                      <h5 class="text-muted">{{ $menu->price }} DH</h5>
                    </div>
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
                      <option value="{{ $servant->id }}" {{ $servant->id === $sale->servant_id ? "selected" : "" }}>{{ $servant->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      Qté
                    </div>
                    <input type="number" name="quantity" value="{{ $sale->quantity }}" class="form-control @error('quantity') is-invalid @enderror" placeholder="Tapez la quantité du menu">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      DH
                    </div>
                    <input type="number" name="total_price" value="{{ $sale->total_price }}" class="form-control @error('total_price') is-invalid @enderror" placeholder="Tapez le prix de menu">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      RECUS
                    </div>
                    <input type="number" name="total_received" value="{{ $sale->total_received }}" class="form-control @error('total_received') is-invalid @enderror" placeholder="Tapez le total reçu de menu">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-text">
                      RESTE
                    </div>
                    <input type="number" name="change" value="{{ $sale->change }}" class="form-control @error('change') is-invalid @enderror" placeholder="Tapez le reste de menu">
                  </div>
                  <div class="form-group">
                    <select class="form-control @error('payment_type') is-invalid @enderror" name="payment_type">
                      <option value="" disabled>Type de Paiement</option>
                      <option value="cash" {{ $sale->payment_type === "cash" ? "selected" : "" }}>Espèce</option>
                      <option value="card" {{ $sale->payment_type === "card" ? "selected" : "" }}>Carte Bancaire</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control @error('payment_status') is-invalid @enderror" name="payment_status">
                      <option value="" disabled>Etat de Paiement</option>
                      <option value="paid" {{ $sale->payment_type === "paid" ? "selected" : "" }}>Payé</option>
                      <option value="unpaid" {{ $sale->payment_type === "unpaid" ? "selected" : "" }}>Impayé</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="button" data-toggle="modal" data-target="#modifierVente" class="btn btn-outline-success btn-block">Modifier la vente</button>
                  </div>
                  <!-- Modal -->
                    <div class="modal fade" id="modifierVente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Modifier une vente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h5>Êtes-vous sûr que vous voulez modifier cette vente ?</h5>
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
