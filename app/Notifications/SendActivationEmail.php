<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendActivationEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * SendActivationEmail constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->onQueue('social');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Activation email')
                    ->greeting('Hello!')
                    ->line('You need to activate your email before you can start using all of our services.')
                    ->action('Activate Email', route('authenticated.activate', ['token' => $this->token]))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
