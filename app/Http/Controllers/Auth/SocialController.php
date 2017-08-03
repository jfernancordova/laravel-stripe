<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Traits\ActivationTrait;
use App\Social;
use App\User;


class SocialController extends Controller
{

    use ActivationTrait;

    /**
     * @param $provider
     * @return $this
     */
    public function getSocialRedirect($provider)
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('public')
                ->with('error','No such provider');
        }

        return Socialite::driver($provider)->redirect();

    }

    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getSocialHandle($provider)
    {
        if (Input::get('denied') != '') {

            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');

        }

        $user = Socialite::driver($provider)->user();

        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {

            $socialUser = $userCheck;
        }
        else {

            $sameSocialId = Social::where('social_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                $newSocialUser              = new User;
                $newSocialUser->email       = $email;
                $newSocialUser->name        = $user->name;
                $newSocialUser->password    = bcrypt(str_random(16));
                $newSocialUser->token       = str_random(64);
                $newSocialUser->activated   = false; //!config('settings.activation');
                $newSocialUser->save();
                $socialData                 = new Social;
                $socialData->social_id      = $user->id;
                $socialData->provider       = $provider;
                $newSocialUser->social()->save($socialData);

                $this->initiateEmailActivation($newSocialUser);

                $socialUser = $newSocialUser;
            }
            else {
                $socialUser = $sameSocialId->user;
            }

        }

        auth()->login($socialUser, true);

        return redirect()->route('profile');

    }


}