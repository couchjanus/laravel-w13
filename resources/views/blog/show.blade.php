<!-- resources/views/blog/show.blade.php -->
@extends('layouts.blog')

@section('title')
	Blog Post | {{ $post->title }}
@endsection

@section('content')
  <!-- Latest Posts -->
  @include('blog.partials._single')
@endsection
