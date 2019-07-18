@extends('layouts.admin')
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb')
@endsection
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Admin User</h1>
    <div class="btn-toolbar mb-2 mb-md-0">

      <div class="btn-group mr-2">
        <a href="{{ route('admins.index') }}" title="All admin users">
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

  <form action="{{ route('admins.store') }}" method="post">
    @csrf
    <div class="card">
      <div class="card-block">
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" class="form-control type="text"  required>
          @if ($errors->has('name')) 
            <div class="alert alert-danger">{{ $errors->first() }}</div>
          @endif
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input name="email" class="form-control" type="email" required>

          @foreach ($errors->get('email') as $message)
            @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          @endforeach
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" value="" required>
          @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
          <label for="roles">Role name*
          <span class="btn btn-info btn-xs select-all">Select all</span>
          <span class="btn btn-info btn-xs deselect-all">Deselect all</span>
        </label>
          <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
            @foreach($roles as $id => $roles)
              <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                {{ $roles }}
              </option>
            @endforeach
          </select>
          @if($errors->has('roles'))
            <p class="help-block">
              {{ $errors->first('roles') }}
            </p>
          @endif
          <p class="helper-block"></p>
        </div>
    
      </div>

      <div class="card-footer text-muted">
        <div class="pull-right">
          <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Save</button>
        </div>
      </div>
    </div>
  </form>
@endsection
@section('scripts')
    @parent
    <script>
        $(".select-all").click(function(){
            $("#roles > option").prop("selected","selected");
            $("#roles").trigger("change");
        });
        $(".deselect-all").click(function(){
            $("#roles > option").prop("selected","");
            $("#roles").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
