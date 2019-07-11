<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $this->service->updateInformation($request->all());
        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function showPasswordForm(Profile $profile)
    {
        return view('profile.security');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function storePassword(ProfilePasswordRequest $request, Profile $profile)
    {
        $this->service->updatePassword($request->get('password'));

        return redirect()->route('profile');
    }

    public function showDeleteAccountConfirmation()
    {
        return view('profile.delete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function deleteAccount()
    {
        $this->service->deleteAccount();

        return redirect()->route('home');
    }
}
