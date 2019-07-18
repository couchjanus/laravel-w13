<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::paginate();
        return view('admin.admins.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.admins.create', compact('roles'))->withTitle('Admins Management')->withBreadcrumbItem('Add Admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        
        $user->roles()->sync($request->input('roles', []));
        
        return redirect()->route('admins.index')->with('success','Admin User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit')->withUser($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->update($request->all());
        return redirect(route('admins.index'))->with('success','User has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')
                ->with('success','User deleted successfully');
    }

    public function trashed()
    {
        $users = Admin::onlyTrashed()->paginate(env('LIST_PAGINATION_SIZE'));
        return view('admin.admins.trashed', compact('users'));
    }

    public function restore($id)
    {
        Admin::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('admins.trashed'))->with('success', 'User has been restored successfully');
    }

    public function userDestroy($id)
    {
        Admin::trash($id)->forceDelete();
        return redirect()->route('admins.index')
                ->with('success','User deleted from tresh successfully');
    }
}
