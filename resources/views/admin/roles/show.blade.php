@extends('layouts.admin')
@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Show Role</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm" title="All roles">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
        </a>
        <a href="{{ route('roles.create') }}" title="Add New Roles">
            <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
        </a>
      </div>
      
      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>

<div class="card">
    <div class="card-header">
        Role
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        Role Name
                    </th>
                    <td>
                        {{ $role->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Permissions
                    </th>
                    <td>
                        @foreach($role->permissions as $id => $permissions)
                            <span class="label label-info label-many">{{ $permissions->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection