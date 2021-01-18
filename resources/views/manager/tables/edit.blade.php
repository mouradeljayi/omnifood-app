@extends('layouts.master')

@section('title', 'Modifier Table')

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
                  <i class="fas fa-edit"></i> Modifier une Table
                </h3>
              </div>
              <form class="mt-3" action="{{ route('tables.update', $table->slug) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="{{ $table->name }}">
                </div>
                <div class="form-group">
                  <select class="custom-select" name="status">
                    <option disabled>Disponible</option>
                    <option value="1" @if($table->status === 1) selected @endif >OUI</option>
                    <option value="0" @if($table->status === 0) selected @endif >NON</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-warning">Modifier</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
