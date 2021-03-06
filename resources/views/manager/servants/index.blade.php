@extends('layouts.master')

@section('title', 'Sérveurs')

@section('content')
<div class="container">
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
            <div class="col-md-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
              <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-2">
                <h3 class="text-secondary">
                  <i class="fas fa-user-cog"></i> Les Sérveurs
                </h3>
                <button type="button" data-toggle="modal" data-target="#exampleModal2" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ajoutez un sérvent"> <i class="fas fa-plus fa-x2"></i> </button>
              </div>
              @if($servants->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col"> <h6>NOM et PRENOM</h6> </th>
                    <th> <h6>ADRESSE</h6> </th>
                    <th scope="col"> <h6>ACTIONS</h6> </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($servants as $servant)
                  <tr>
                    <td> <h5>{{ $servant->name }}</h5> </td>
                    <td>
                      @if($servant->address)
                      <h5>
                        {{ $servant->address }}
                      </h5>
                      @else
                      <h5>
                        Non Disponible
                      </h5>
                      @endif
                    </td>
                    <td>
                      <div class="d-flex justify-content-start">
                        <a href="{{ route('servants.edit', $servant->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('servants.destroy', $servant->id) }}" method="post">
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
                Il n'y a pas de sérveur pour le moment!
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $servants->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Start Modal (Add Servant)-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-plus fa-x2"></i> Ajoutez un nouveau sérveur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('servants.create') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Tapez le nom du sérveur">
          </div>
          <div class="form-group">
            <input type="text" name="address" placeholder="Tapez l'adresse du sérveur" class="form-control">
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Ajoutez</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Modal (Add Servant)-->
@endsection
