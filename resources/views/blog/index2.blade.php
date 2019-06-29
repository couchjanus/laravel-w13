<!-- resources/views/blog/index.blade.php -->
@extends('layouts.blog')

@section('title')
	Blog
@endsection

@section('content')
<h1>{{ $title }}</h1>
<div class="row">
    <!-- post -->
    @forelse ($posts as $post)
        @include('blog.partials._chunk')
    @empty
        @include('blog.partials._post-none')
    @endforelse
</div>
<!-- Pagination -->
<nav aria-label="Page navigation example">
  <ul class="pagination pagination-template d-flex justify-content-center">
    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
    <li class="page-item"><a href="#" class="page-link active">1</a></li>
    <li class="page-item"><a href="#" class="page-link">2</a></li>
    <li class="page-item"><a href="#" class="page-link">3</a></li>
    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
  </ul>
</nav>
@endsection
