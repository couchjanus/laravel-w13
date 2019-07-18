@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h2 class="h2">Admin Users</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('admins.create') }}" title="Add New Users">
              <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
          </a>
          <a href="{{ route('admins.trashed') }}" title="Trashed Users"><button class="btn btn-sm btn-outline-secondary"><span data-feather="trash"></span> Trashed List</button>
          </a>
        </div>
      </div>
  </div>
    
  <div class="table-responsive">

    <table class="table table-hover">
      @if($users->count() === 0)
        <div class="well text-center">No users found.</div>
      @else
      <thead>
        <tr>
          <th>Id</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
          @foreach($users as $user)
          <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                  <a title="Show User" href="{{ route('admins.show', ['id'=> $user->id]) }}" class="btn btn-primary"><span class="fa fa-newspaper-o"></span></a>
                  <a title="Edit user" href="{{ route('admins.edit', ['id'=> $user->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                  <form action="{{ route('admins.destroy', ['id' => $user->id]) }}" method="post" style="display: inline">@method('DELETE') @csrf
                    <button title="Delete user" type="submit" class="btn btn-outline-danger"><span data-feather="trash"></span></button>
                  </form>  
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Pagination -->
  <div class="pagination justify-content-center mb-4">
      {{ $users->links() }}
  </div>
  @endif
@endsection
