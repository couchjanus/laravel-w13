<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreFormRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        // dump($users);
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
        return view('admin.users.create')->withTitle('Users Management')->withBreadcrumbItem('Add User');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $messages = [
    //         'email.required' => 'We need to know your e-mail address!',
    //     ];
        
    //     $this->validate($request, [
    //         'name' => ['required', 'string', 'max:50', 'min:3'],
    //         'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8'],
    //     ], $messages);

    //     return User::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    // }

    // UserStoreFormRequest
    
    public function store(UserStoreFormRequest $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('users.index')->with('success','User created successfully');;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->withUser($user)->withTitle('Users Management')->withBreadcrumbItem('Show User');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->withUser($user)->withTitle('Users Management')->withBreadcrumbItem('Edit User');
    }
 
    // public function rules() {
    //    return [
    //         'email' => ['required', 'string', 'email', 'max:255',
    //             Rule::unique('users')->ignore($this->user),
    //         ],
    //     ];
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    // public function userDestroy($id)
    // {
    //     $user = User::withTrashed()
    //             ->findOrFail($id);
    //     // dd($user);
    //     $user->forceDelete();
    //     return redirect()->route('users.index');
    
    // }

    public function userDestroy($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('users.index');
    }
}
