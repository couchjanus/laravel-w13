@extends('layouts.admin')
<!-- Breadcrumbs-->
@section('breadcrumb')
  @include('layouts.partials.admin._breadcrumb')
@endsection
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{ route('posts.index') }}" title="All posts">
                <button class="btn btn-sm btn-outline-success"><span data-feather="arrow-left"></span>
                     Go Back</button>
            </a>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
          </div>

          <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
    </div>
    
    <form action="{{ route('posts.update',['id' => $post->id]) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" class="form-control" type="text" value="{{ $post->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" class="form-control" rows="10">{{ $post->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Select Category</label>
                        <select name="category_id" class="form-control selectpicker">
                            @foreach ($categories as $key => $value)
                                <option value="{{ $key }}"
                                    @if ($key == $post->category_id)
                                        selected="selected"
                                    @endif
                                    >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control selectpicker">
                                @foreach($status as $key => $value)
                                    <option value="{{ $key }}" 
                                    @if ($key == $post->status)
                                            selected="selected"
                                        @endif
                                        >{{ $value }}
                                    </option>
                                @endforeach
                            </select>
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
