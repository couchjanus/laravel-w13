<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $breadcrumbItem = 'Categories';
        $title = 'Categories management';
        $order = 'asc'; 
        $categories = Category::paginate();
        
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
        $this->validate($request, [
            'name' => 'required|unique:categories|max:50',
            'description' => 'nullable|string',
        ]);

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:categories|max:255',
        //     'description' => 'nullable|string',
        // ]);

        // Переданные данные не прошли проверку
        // if ($validator->fails()) {
        //     return redirect('admin/categories/create')
        //             ->withErrors($validator)
        //             ->withInput();
        // }

        // if ($validator->fails())
        // {
        //     // Переданные данные не прошли проверку
        //     return back()->withErrors($validator->messages()->first());
        // }

        // $validator->after(function ($validator) {
        //     if ($this->somethingElseIsInvalid()) {
        //         $validator->errors()->add('name', 'Something is wrong with this field!');
        //     }
        // });

        // if ($validator->fails()) {
        //     return redirect('admin/categories/create')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|string',
        ])->validate();
 
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
