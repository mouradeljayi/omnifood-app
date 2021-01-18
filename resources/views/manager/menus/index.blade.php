@extends('layouts.master')

@section('title', 'Menus')

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
                  <i class="fas fa-clipboard-list"></i> Les Menus
                </h3>
                <button type="button" data-toggle="modal" data-target="#exampleModal4" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ajoutez un Menu"> <i class="fas fa-plus fa-x2"></i> </button>
              </div>
              @if($menus->count())
              <table class="table table-hover table-bordered table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th scope="col">TITRE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">PRIX</th>
                    <th scope="col">CATEGORIE</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($menus as $menu)
                  <tr>
                    <td>{{ $menu->title }}</td>
                    <td> <img src="{{ asset('images/menus/' . $menu->image) }}" width="60" height="60" class="fluid rounded" alt=""> </td>
                    <td>{{ substr($menu->description,0,100) }}</td>
                    <td>{{ $menu->price }}</td>
                    <td>{{ $menu->category->name }}</td>
                    <td>
                      <div class="d-flex justify-content-start">
                        <a href="{{ route('menus.edit', $menu->slug) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('menus.destroy', $menu->slug) }}" method="post">
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
                Il n'y a pas de menu pour le moment!
              </div>
              @endif
              <div class="d-flex justify-content-center align-items-center ">
                {{ $menus->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Start Modal (Add Menu)-->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-plus fa-x2"></i> Ajoutez une nouvelle Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('menus.create') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Tapez le titre du menu">
          </div>
          <div class="form-group">
          <textarea name="description" rows="6" cols="80" class="form-control">Tapez la description du menu</textarea>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-text">
              DH
            </div>
            <input type="number" name="price" class="form-control" placeholder="Tapez le prix du menu">
          </div>
          <div class="form-group">
            <select class="custom-select" name="category_id">
              <option selected disabled>Catégorie</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Insérez l'image du menu</label>
            <input type="file" name="image" class="form-control">
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Ajoutez</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Modal (Add Table)-->
@endsection
