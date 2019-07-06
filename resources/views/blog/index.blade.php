<!-- resources/views/blog/index.blade.php -->
@extends('layouts.blog')

@section('title')
	Blog
@endsection

@section('content')
<h1>{{ $title }}</h1>
<div class="row">
    <!-- post -->
    @each('blog.partials._chunk', 
            $posts, 
            'post', 
            'blog.partials._post-none'
        )
</div>
<!-- Pagination -->
{{-- {{ $posts->links() }} --}}
{{-- {!! $posts->render() !!} --}}
{{ $posts->onEachSide(2)->links() }}
@endsection
