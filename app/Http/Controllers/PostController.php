<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use App\Enums\PostStatusType;

class PostController extends Controller
{
    /**
     * Show a list of all of the application's posts.
     *
     * @return Response
     */

    public function index()
    {
        $posts = Post::withCount('comments')->where([
            'status' => PostStatusType::Published])->orderBy('updated_at', 'desc')->paginate();
        return view('blog.index', compact('posts'))->withTitle('Peculiar Blog');
    }


    public function show($slug)
    {
        if (is_numeric($slug)) {
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
        }
        
        $post = Post::whereSlug($slug)->firstOrFail();
        
        $hasComments = $post::has('comments') ? true : false;
        
        return view('blog.show')->withPost($post)->withHasComments($hasComments);
   
    }

    public function getPostsByCategory($categoryId)
    {
        $posts = Post::where([
                'status' => PostStatusType::Published, 
                'category_id' => $categoryId])
            ->with('category')
            ->orderBy('updated_at', 'desc')
            ->paginate();
        return view('blog.index')->with(compact('posts'))->withTitle('Awesome Blog');
    }

}
