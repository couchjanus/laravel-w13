<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreFormRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Profile;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('user-access'), 403);
        $users = User::paginate(10);
        return view('admin.users.index', ['users' => $users])->withTitle('Users Management')->withBreadcrumbItem('All Users');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(env('LIST_PAGINATION_SIZE'));
        return view('admin.users.trashed', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('users.trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('user-create'), 403);

        $roles = Role::all()->pluck('name', 'id');
        return view('admin.users.create', compact('roles'))->withTitle('Users Management')->withBreadcrumbItem('Add User');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(UserStoreFormRequest $request)
    {
        abort_unless(\Gate::allows('user-create'), 403);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    
        $user->roles()->sync($request->input('roles', []));

        $profile = new Profile();
        $user->profile()->save($profile);
        
        return redirect()->route('users.index')->with('success','User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_unless(\Gate::allows('user-show'), 403);

        $user->load('roles');
        return view('admin.users.show', compact('user'))->withUser($user)->withTitle('Users Management')->withBreadcrumbItem('Show User');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user-edit'), 403);

        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('admin.users.edit', compact('roles', 'user'))->withTitle('Users Management')->withBreadcrumbItem('Edit User');
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user-edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user-delete'), 403);

        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

    public function userDestroy($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('users.index')->with('success','User force deleted successfully');
    }
}
