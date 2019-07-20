<div class="post-comments">
    <header>
        <h3 class="h6">Post Comments<span class="no-of-comments">({{ count($post->comments) }})</span></h3>
    </header>
    
    <!-- Comments Form -->
    @foreach ($post->comments as $comment)
    <div class="comment">
        <div class="comment-header d-flex justify-content-between">
            <div class="user d-flex align-items-center">
                <div class="image"><img src="/images/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title"><strong>{{ $comment->creator->name }}</strong><span class="date">{{ $comment->created_at }}</span></div>
            </div>
        </div>
        <div class="comment-body">
            <p>{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach 
</div>


@if (Auth::check())
    <h4>Hello {!! Auth::user()->name !!}!</h4>
    <comments :post-id='{!! $post->id !!}' :user-id='{!! Auth::user()->id !!}'></comments>
@else
    <comments :post-id='{!! $post->id !!}'></comments>
@endif  
