<?php

namespace App\Logic\Activation;

use App\Activation;
use App\User;
use App\Notifications\SendActivationEmail;
use Carbon\Carbon;

class ActivationRepository
{

    /**
     * @param User $user
     * @return bool
     */
    public function createTokenAndSendEmail(User $user)
    {

        $activations = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

        if ($activations >= 3) {
            return true;
        }

        if ($user->activated) {

            $user->update([
                'activated' => false
            ]);

        }

        $activation = new Activation;
        $activation->user_id = $user->id;
        $activation->token = str_random(64);
        $activation->save();

        $user->notify(new SendActivationEmail($activation->token));

    }

    /*
     * @return void
     */
    public function deleteExpiredActivations()
    {
        Activation::where('created_at', '<=', Carbon::now()->subHours(72))->delete();
    }
}