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
      <div class="post col-xl-6">
        <div class="post-thumbnail">
          <a href="post.html"><img src="images/cat1.jpg" alt="..." class="img-fluid"></a>
        </div>
        <div class="post-details">
          <div class="post-meta d-flex justify-content-between">
            <div class="date meta-last">{{ $post->created_at }}</div>
            <div class="category"><a href="#">Business</a></div>
          </div>
          <a href="/blog/{{ $post->id }}">
            <h3 class="h4">{{ $post->title }}</h3>
          </a>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
          <footer class="post-footer d-flex align-items-center">
            <a href="#" class="author d-flex align-items-center flex-wrap">
              <div class="avatar">
                <img src="images/user.svg" alt="..." class="img-fluid">
              </div>
              <div class="title"><span>John Doe</span></div>
            </a>
            <div class="date"><i class="fas fa-clock"></i> 2 months ago</div>
            <div class="comments meta-last"><i class="fas fa-comment"></i> 12</div>
          </footer>
        </div>
      </div>
    @empty
        <h2>No posts yet!</h2>
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
