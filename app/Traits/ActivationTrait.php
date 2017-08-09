<?php

namespace App\Traits;

use App\Logic\Activation\ActivationRepository;
use App\User;
use Illuminate\Support\Facades\Validator;

trait ActivationTrait
{

    /**
     * @param User $user
     * @return boolean
     */
    public function initiateEmailActivation(User $user)
    {

        if ( !config('settings.activation')  || !$this->validateEmail($user)) {

            return true;
        }

        $activationRepostory = new ActivationRepository();
        $activationRepostory->createTokenAndSendEmail($user);

    }


    /**
     * @param User $user
     * @return bool
     */
    protected function validateEmail(User $user)
    {

        $validator = Validator::make(['email' => $user->email], ['email' => 'required|email']);

        if ($validator->fails()) {
            return false;
        }

        return true;

    }

}