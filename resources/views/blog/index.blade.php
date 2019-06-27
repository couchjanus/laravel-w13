<!-- resources/views/blog/index.blade.php -->
<html>
  <body>
    <h1>{{ $title }}</h1>
     
    <?php
      if ($count>0) {
        echo '<h2>There are '.$count.' posts</h2>';
        foreach ($posts as $post) {
          echo '<h2>'.$post->title.'</h2>';
          echo '<a href="/blog/'.$post->id.'"><button>Read More</button></a>';
        }
      } else {
        echo '<h2>No posts yet</h2>';
      }
    ?>
  </body>
</html>
