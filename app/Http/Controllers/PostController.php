<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show a list of all of the application's posts.
     *
     * @return Response
     */
    // public function index()
    // {
    //     $posts = DB::select('select * from posts');
    //     return $posts;
    //     // return view('blog.index', ['posts' => $posts, 'title'=>'Peculear Blog']);
    // }

    public function index()
    {
        // $posts = DB::table('posts')->get();
        $count = DB::table('posts')->count();
        $posts = DB::table('posts')->paginate(4);
        // $posts = DB::table('posts')->simplePaginate(10);
        
        // return view('blog.index', ['posts' => $posts, 'title'=>'Peculiar Blog', 'count'=>$count]);
        return view('blog.index3', compact('posts'))->withTitle('Peculiar Blog');
    }

    public function show($id)
    {
        $post = DB::table('posts')->find($id);
        
        // return view('blog.show', ['post' => $post]);
        return view('blog.show', ['post' => $post, 'hasComments'=>false]);
        
    }
}
