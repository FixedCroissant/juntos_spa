<?php

namespace App\Listeners;

use App\Events\NotifyJuntos;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;


class SendJuntosAdminNotice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NotifyJuntos  $event
     * @return void
     */
    public function handle(NotifyJuntos $event)
    {
        $userInfo = $event->user;

        \Mail::send([
            'html' => 'mail.juntos_notification',
        ], [
            'user' => $userInfo
        ], function ($message) {
            $message
                ->to(env('MAIL_NEW_REGISTRATION_TO_DEPT', 'testing@test.com'))
                ->subject("JUNTOS DATABASE - New User Registered!");
        });
    }
}
