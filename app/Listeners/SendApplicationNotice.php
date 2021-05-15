<?php

namespace App\Listeners;

use App\Events\CheckCoachingFollowUp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;


class SendApplicationNotice
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
     * @param  CheckCoachingFollowUp  $event
     * @return void
     */
    public function handle(CheckCoachingFollowUp $event)
    {
        $userinfo = $event->user;
        $daySetting = Settings::select('coordinator_follow_up_meeting_past_due')->first();

       $pendingAppointments = DB::table('coach_appointments')
                                ->where('user_id',$userinfo->id)
                                ->whereRaw('DATE_ADD(appointment_date, INTERVAL '.$daySetting->coordinator_follow_up_meeting_past_due.' DAY) < NOW()')
                                ->whereNull('appointment_follow_up_date')
                                ->select('id','appointment_date','appointment_follow_up_date')
                                ->get();

       if(count($pendingAppointments)>0){
            session()->flash('flash_message', 'Thank you for logging in! You have '. count($pendingAppointments).' coaching appointment with no follow up.');
        }
    }
}
