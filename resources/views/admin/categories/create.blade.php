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
            <a href="{{ route('categories.index') }}" class="btn btn-success btn-sm" title="All categories">
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

  <div class="table-responsive">

    <form action="{{ route('categories.store') }}" method="post">
      @csrf
      <div class="card">
        <div class="card-block">
          <div class="form-group">
            <label for="title">Category Name:</label>
            <input name="name" class="form-control" type="text" placeholder="Enter name" required>
          </div>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label for="description">Category Description:</label>
              <input name="description" class="form-control" type="text" placeholder="Enter description">
          </div>
        </div>
        <div class="card-block">
          <div class="form-group">
            <label for="active">Is Active:</label>
            <input type="radio" name="active" value="yes" checked> Yes 
            <input type="radio" name="active" value="No"> No
          </div>
        </div>
       
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-primary btn-sm pull-right"><span data-feather="save"></span> Save</button>
        </div>
                
      </div>
    </form>
  </div>
@endsection  
