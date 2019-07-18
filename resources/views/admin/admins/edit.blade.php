@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
      
      @if (Session::get('message') != Null)
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
      @endif

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong>Edit</strong> User
              <a href="{{ route('admins.index') }}" class="btn btn-success btn-sm" title="All Admins">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
              </a>
          </div>
          
          <form action="{{ route('admins.update',['id' => $user->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="card-body">
              
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="name">User Name</label>
                <div class="col-md-9">
                  <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                  <span class="help-block">Enter User Name</span>
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ $user->email }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_super" id="is_super" {{ ($user->is_super) ? 'checked' : '' }}>

                        <label class="form-check-label" for="is_super">
                            {{ __('Super Admin') }}
                        </label>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
              <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
