<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getProfile()
    {
        return view('profiles.users.profile');
    }

    /**
     * Uploading the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadUser(Request $request)
    {
        $messages = [
            'name.required'    => 'Please enter a valid last name.',
        ];

        $validate = \Validator::make($request->all(), [

            'name'          =>  'required|max:255',
            'email'         =>  'required|unique:users,email,'.\Auth::user()->id,

        ], $messages);

        if(!$validate->passes())
        {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $user               = User::find(\Auth::user()->id);
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->password     = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('message', 'Profile Uploaded!');

    }



}