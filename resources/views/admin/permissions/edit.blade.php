@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Edit permission</h2></div>
          <div class="panel-body">

            <a href="{{ route('permissions.index') }}" class="btn btn-success btn-sm" title="All categories">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
            <br/>
            <div class="table-responsive">
              <form action="{{ route('permissions.update',$permission->id) }}" method="post">
                @method("PUT")
                @csrf
                <div class="card">
                    <div class="card-block">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input name="name" class="form-control" type="text" value="{{ $permission->name }}" required>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@endsection  
