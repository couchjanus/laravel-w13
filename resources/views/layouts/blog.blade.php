<!-- Хранится в resources/views/layouts/blog.blade.php -->
@extends('layouts.master')

@section('title')
	Peculiar Blog
@endsection

@section('meta')
   <!-- Custom meta for this template -->
   @include('layouts.partials.front._meta')
@endsection

@section('styles')
   <!-- Custom styles for this template -->
   @include('layouts.partials.front._styles')
@endsection

@section('navbar')
<header class="header">
    <!-- Main Navbar-->
    @include('layouts.partials.front._navbar')      
</header>
@endsection

@section('main')                    
    <div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            @yield('content')
          </div>
        </main>
        <!-- Sidebar -->
        @include('layouts.partials.front._sidebar')
      </div>
    </div>
@endsection
<!-- Page Footer-->
@section('footer')                    
   @include('layouts.partials.front._footer')      
@endsection
@section('scripts')
    <!-- Custom scripts for this template -->
    @include('layouts.partials.front._scripts')
@endsection
