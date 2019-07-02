@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb')
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">{{ $title }}</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('categories.create') }}" title="Add New category">
            <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
        </a>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      
      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
</div>

<div class="table-responsive">
  <table class="table table-hover table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th> <a href="{{ route('categories.sort', ['order' => ($order=='desc')?'asc':'desc']) }}">Modified</a>
        </th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ date('d F Y', strtotime($category->updated_at)) }}</td>
          <td>
            <a title="Read category" href="{{ route('categories.show', ['id'=> $category->id]) }}" class="btn btn-primary"><span data-feather="eye"></span></a>
            <a title="Edit category" href="{{ route('categories.edit', ['id'=> $category->id]) }}" class="btn btn-warning"><span data-feather="edit"></span></a>
            <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post" style="display: inline">@method('DELETE') @csrf
              <button title="Delete category" type="submit" class="btn btn-outline-danger"><span data-feather="trash"></span></button>
            </form>  
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $categories->onEachSide(2)->links() }}

</div>

@endsection