<!-- resources/views/blog/show.blade.php -->
@extends('layouts.blog')

@section('title')
	Blog Post | {{ $post->title }}
@endsection

@section('content')

  <!-- Latest Posts -->
  @include('blog.partials._single')
  
  @component('alert')
    <strong>Whoops!</strong> Something went wrong!
  @endcomponent

  @component('alert-danger')
    @slot('title')
      Forbidden
    @endslot
    You are not allowed to access this resource!
  @endcomponent

  @alert(['type' => 'danger'])
    You are not allowed to access this resource!
  @endalert

  @push('sidebar')
    <li>Sidebar list item</li>
  @endpush

  @prepend('sidebar')
    <li>First Sidebar Item</li>
  @endprepend


@endsection
