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