<div class="post-single">

    <div class="post-thumbnail">
      <img src="/images/cat1.jpg" alt="..." class="img-fluid">
    </div>
        
    <div class="post-details blog-post">
      <div class="post-meta d-flex justify-content-between">
        <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
      </div>
          
      <h1>{{ $post->title }}<a href="#"><i class="fas fa-bookmark-o"></i></a></h1>

      <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
        <a href="#" class="author d-flex align-items-center flex-wrap">
          <div class="image"><img src="/images/user.svg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title"><span>John Doe</span></div>
        </a>
            
        <div class="d-flex align-items-center flex-wrap">       
          <div class="date"><i class="icon-clock"></i> 2 months ago</div>
          <div class="views"><i class="icon-eye"></i> 500</div>
          <div class="comments meta-last"><i class="icon-comment"></i>12</div>
        </div>
      </div>
      
      <div class="post-body">
        <p class="lead">{{ $post->content }}</p>
      </div>
    
      <div class="post-tags">
        <a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a>
      </div>
      {{-- comments --}}
      @includeWhen($hasComments, 'blog.partials._comments', ['some' => 'data'])
      {{-- @include('blog.partials._comments') --}}
    </div>
  </div>