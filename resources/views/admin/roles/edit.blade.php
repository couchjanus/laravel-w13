@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Edit role</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
          <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm" title="All roles">
              <span data-feather="arrow-left"></span>  Go Back
          </a>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      
      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>

  <form action="{{ route('roles.update',['id' => $role->id]) }}" method="post">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="card">
      <div class="card-block">
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" class="form-control" type="text" value="{{ $role->name }}" required>
        </div>
                   
        <div class="form-group">
          <label for="selectall-permission" class= 'control-label'>Select permissions</label>
          <button type="button" class="btn btn-primary btn-xs" id="selectbtn-permission">
            Select all
          </button>
          <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-permission">
            Deselect all
          </button>
          <select name="permissions[]" id="selectall-permission" class="form-control select2" multiple="multiple">
            @foreach($permissions as $id => $permissions)
              <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                {{ $permissions }}
              </option>
            @endforeach
          </select>
          @if($errors->has('permissions'))
            <p class="help-block">
              {{ $errors->first('permissions') }}
            </p>
          @endif
          <p class="helper-block"></p>
        </div>
      </div>
      <div class="card-footer text-muted">
        <div class="pull-right">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </form>
@endsection  
@section('scripts')
    @parent
    <script>
        $("#selectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","selected");
            $("#selectall-permission").trigger("change");
        });
        $("#deselectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","");
            $("#selectall-permission").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection