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
        $posts = DB::table('posts')->get();

        $count = DB::table('posts')->count();
        // $maxId = DB::table('posts')->max('id');

        // return view('blog.index', ['posts' => $posts, 'title'=>'Peculiar Blog']);
        return view('blog.index', ['posts' => $posts, 'title'=>'Peculiar Blog', 'count'=>$count]);

    }

    public function show($id)
    {
        // $post = DB::select("select * from posts where id = :id", ['id' => $id])[0];
        // $post = DB::table('posts')->where('id', $id)->first();
        $post = DB::table('posts')->where('id', $id)->value('title');
        return $post;
        // $post = DB::table('posts')->find($id);
        // return view('blog.show', ['post' => $post]);
    }
}
