@extends('layouts.admin')

<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb')
@endsection
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('users.index') }}" title="All users">
            <button class="btn btn-sm btn-outline-success"><span data-feather="arrow-left"></span>Go Back</button>
        </a>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>

      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
<form action="{{ route('users.update',['id' => $user->id]) }}" method="post">
        @csrf
        @method("PUT")
        <div class="card">
            <div class="card-block">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" class="form-control type="text" value="{{ $user->name }}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" class="form-control" type="email" value="{{ $user->email }}" required>
                    @foreach ($errors->get('email') as $message)
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" value="{{ $user->password }}" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
    
            </div>

            <div class="card-footer text-muted">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Update</button>
                </div>
            </div>
        </div>
    </form>


<div class="container-fluid">
  <div class="animated fadeIn">
   
@endsection
