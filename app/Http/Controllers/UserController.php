<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getProfile()
    {
        return view('profiles.users.profile');
    }


}