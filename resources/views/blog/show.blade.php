<!-- resources/views/blog/show.blade.php -->
<html>
  <body>
    <h1 class="blog-post-title">{{ $post->title }}</h1>

    <div class="blog-post">
        <p class="blog-post-meta"><?=$post->created_at;?></p>
        <blockquote>
            <p><?=$post->content;?></p>
        </blockquote>
    </div><!-- /.blog-post -->
  </body>
</html>
