@extends('admin.layouts.base')

@section('title', 'List Movie')

@section('content')
    
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Movies</h3>
        </div>

        @if (Session::has('success'))
            <div class="alert-danger mt-3 mb-3 p-3">
              {{ Session('success') }}
            </div>
        @endif

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('movie.create') }}" class="btn btn-success mb-3">
                Create Movie</a>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Categories</th>
                    <th>Casts</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>   
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{ $movie->id }}</td>
                            <td>{{ $movie->title }}</td>
                            <td>
                                <img src="{{ asset('storage/thumbnail/'.$movie->small_thumbnail) }}" alt="" width="40%">
                            </td>
                            <td>{{ $movie->categories }}</td>
                            <td>{{ $movie->casts }}</td>
                            <td>
                                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-warning">
                                  <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('movie.delete', $movie->id) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="sumbit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                  </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach               
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection