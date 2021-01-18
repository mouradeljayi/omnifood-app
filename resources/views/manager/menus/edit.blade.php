@extends('layouts.master')

@section('title', 'Modifier Menu')

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
                <h3 class="text-warning">
                  <i class="fas fa-edit"></i> Modifier une Menu
                </h3>
              </div>
              <form action="{{ route('menus.update', $menu->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <input type="text" name="title" class="form-control" value="{{ $menu->title }}">
                </div>
                <div class="form-group">
                <textarea name="description" rows="6" cols="80" class="form-control">{{ $menu->description }}</textarea>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-text">
                    DH
                  </div>
                  <input type="number" name="price" class="form-control" value="{{ $menu->price }}">
                </div>
                <div class="form-group">
                  <select class="custom-select" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->name === $menu->category->name) selected @endif >{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <img src="{{ asset('images/menus/' . $menu->image) }}" width="60" height="60" class="fluid rounded mb-2" alt="">
                  <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
