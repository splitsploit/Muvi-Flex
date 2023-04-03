@extends('admin.layouts.base')

@section('title', 'Edit Movie')

@section('content')
    <div class="row">
        <div class="col-md-12">
    
        {{-- Alert Version 1 ( alternative ) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Edit Movie</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('movie.update', $movies->id) }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $movies->title }}">
                </div>
                <div class="form-group">
                <label for="trailer">Trailer</label>
                <input type="text" class="form-control" id="trailer" name="trailer" value="{{ $movies->trailer }}">
                </div>
                <div class="form-group">
                <label for="trailer">Movie</label>
                <input type="text" class="form-control" id="movie" name="movie" value="{{ $movies->movie }}">
                </div>
                <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" value="{{ $movies->duration }}">
                </div>
                <div class="form-group">
                <label>Date:</label>
                <div class="input-group date" id="release-date" data-target-input="nearest">
                    <input type="text" name="release_date" class="form-control datetimepicker-input" data-target="#release-date" value="{{ $movies->release_date }}"/>
                    <div class="input-group-append" data-target="#release-date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                <label for="short-about">Casts</label>
                <input type="text" class="form-control" id="short-about" name="casts" value="{{ $movies->casts }}">
                </div>
                <div class="form-group">
                <label for="short-about">Categories</label>
                <input type="text" class="form-control" id="short-about" name="categories" value="{{ $movies->categories }}">
                </div>
                <div class="form-group">
                <label for="small-thumbnail">Small Thumbnail</label>
                <input type="file" class="form-control" name="small_thumbnail">
                </div>
                <div class="form-group">
                <label for="large-thumbnail">Large Thumbnail</label>
                <input type="file" class="form-control" name="large_thumbnail">
                </div>
                <div class="form-group">
                <label for="short-about">Short About</label>
                <input type="text" class="form-control" id="short-about" name="short_about" value="{{ $movies->short_about }}">
                </div>
                <div class="form-group">
                <label for="short-about">About</label>
                <input type="text" class="form-control" id="about" name="about" value="{{ $movies->about }}">
                </div>
                <div class="form-group">
                <label>Featured</label>
                <select class="custom-select" name="featured">
                    <option value="0" {{ $movies->featured == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $movies->featured == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                </div>
            </div>
            <!-- /.card-body -->
    
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection