<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\PostStatusType;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Requests\PostUpdateFormRequest;
use App\Http\Requests\PostStoreFormRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate();
        $breadcrumbItem = 'Posts';
        $title = 'Posts management';
        $order = 'asc'; 
        $status = PostStatusType::toSelectArray();
        return view('admin.posts.index', compact('posts', 'status', 'order', 'breadcrumbItem', 'title'));

    }
    public function getPostsByStatus(Request $request)
    {
        static $statusPost;
        $breadcrumbItem = 'Posts By Status';
        $title = 'Posts management';
        $status = PostStatusType::toSelectArray();
        // $posts = Post::whereStatus($request->status)->paginate();
        $statusPost = $request->status; 
        $posts = Post::status($statusPost)->paginate(5);
        return view('admin.posts.status', compact('posts', 'status', 'statusPost', 'breadcrumbItem', 'title'));
    }

    public function sortPostsByDate(Request $request)
    {
        $status = PostStatusType::toSelectArray();
        $order = isset($request->order)?$request->order:'desc'; 
        $posts = Post::orderBy('updated_at', $order)->paginate();
        // dump($posts);
        $breadcrumbItem = 'Posts By Date';
        $title = 'Posts management';
       
        return view('admin.posts.index', compact('posts', 'status', 'order', 'breadcrumbItem', 'title'));
    }
    
    public function getByIds($ids)
    {
        // Можно вызвать метод findMany с массивом первичных ключей,
        // который вернет коллекцию подходящих записей:
        // return Post::find($ids);
        // return Post::findMany($ids);
        return Post::whereIn('id', $ids)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(\Auth::id());
        
        $categories = Category::all(); 
        $tags = \App\Tag::all();//get()->pluck('name', 'id');
        $status = PostStatusType::toSelectArray();
        
        return view('admin.posts.create')->withStatus($status)->withCategories($categories)->withTitle('Posts management')->withBreadcrumbItem('Add New Post')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostStoreFormRequest $request)
    {
        $userId = \Auth::id() ?? 1;

        $post = Post::firstOrCreate(['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'category_id'=>$request->category_id, 'user_id'=>$userId]);
        $post->tags()->sync((array)$request->input('tag'));  
        return redirect()->route('posts.index')->with('success','Post created successfully');;
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dump($post);
        // return view('admin.posts.show',compact('post'));
    }

    public function getFirstPublished()
    {
        // Получение первой модели, удовлетворяющей условиям...
        dump(Post::where('status', 2)->first());
        // return Post::where('status', 2)->first();
    }

    public function getFirstOrFail($id)
    {
        dump(Post::findOrFail($id));
        dump(Post::where('status', '>', 2)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id'); 
        $status = PostStatusType::toSelectArray(); 
        $tags = \App\Tag::get()->pluck('name', 'id');
        return view('admin.posts.edit')->withPost($post)->withStatus($status)->withCategories($categories)->withTitle('Posts management')->withBreadcrumbItem('Edit Post')->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update(PostUpdateFormRequest $request, Post $post)
    {
        $post->update(['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'category_id'=>$request->category_id, 'user_id'=>1]);
        $post->tags()->sync((array)$request->input('tag'));
        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('posts.index')
                ->with('success','Post deleted successfully');
    }
}
