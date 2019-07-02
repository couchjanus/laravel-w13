<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Category controller";
        // $categories = Category::all();
        $breadcrumbItem = 'Categories';
        $title = 'Categories management';
        $order = 'asc'; 
        $categories = Category::paginate();
        // $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories', 'breadcrumbItem', 'title', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create')->withTitle('Add New Category')->withBreadcrumbItem('Create New Category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Создание нового экземпляра
        // $category = new Category;
        // $category->name = $request->name;
        // $category->description = $request->description;
        // $category->save();
        
        // $category->fill(['name' => $request->name, 'description' => $request->description]);

        // $category = App\Category::create(['name' =>$request->name, ‘description’ => $request->description]);

        Category::create($request->all());
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // $category = Category::find($id);
        return view('admin.categories.edit')->withCategory($category)->withTitle('Edit Category')->withBreadcrumbItem('Edit Category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

    public function sortByDate(Request $request)
    {
        $order = isset($request->order)?$request->order:'desc';
        $categories = Category::orderBy('updated_at', $order)->paginate();
        $breadcrumbItem = 'Categories';
        $title = 'Categories management';
        return view('admin.categories.index', compact('categories', 'order', 'breadcrumbItem', 'title'));
    }


}
