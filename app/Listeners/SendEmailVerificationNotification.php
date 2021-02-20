<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $to_name = 'rikesh cha';
        $to_email = $event->user->email;
        $data = array('name'=>ucwords($event->user->full_name), 'token'=>'124567');
        Mail::send('emails.mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email, $to_name)
                ->subject('Email Confirmation');
            $message->from('bomzansanjaya@gmail.com',env('APP_NAME'));
        });
    }
}
