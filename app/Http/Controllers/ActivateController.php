<?php

namespace App\Http\Controllers;

use App\Traits\ActivationTrait;
use App\Activation;

class ActivateController extends Controller
{

    use ActivationTrait;

    /*
     * Get the token to activate the email.
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activate($token)
    {
        if (auth()->user()->activated) {
            return redirect()->route('profile')
                ->with('status', 'success')
                ->with('message', 'Your email is already activated.');
        }

        $activation = Activation::where('token', $token)
            ->where('user_id', auth()->user()->id)
            ->first();

        auth()->user()->activated = true;
        auth()->user()->save();

        $activation->delete();

        session()->forget('above-navbar-message');

        return redirect()->route('profile')
            ->with('status', 'success')
            ->with('message', 'You successfully activated your email!');

    }

    /*
     * Resend Email Activation.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resend()
    {
        if (auth()->user()->activated == false) {
            $this->initiateEmailActivation(auth()->user());

            return redirect()->route('profile')
                ->with('status', 'success')
                ->with('message', 'Activation email sent.');
        }

        return redirect()->route('profile')
            ->with('status', 'success')
            ->with('message', 'Already activated.');
    }
}