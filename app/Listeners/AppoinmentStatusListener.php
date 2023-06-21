<?php

namespace App\Listeners;

use App\Events\AppoinmentStatusEvent;
use App\Models\Appoinment;
use App\Models\User;
use App\Notifications\AppoinmentStatusCancelNotification;
use App\Notifications\AppoinmentStatusConfirmNotification;
use Illuminate\Support\Facades\Notification;

class AppoinmentStatusListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(AppoinmentStatusEvent $event)
    {
        $patient = User::find($event->appoinment->patient_id);
        if ($event->appoinment->status == Appoinment::CONFIRMED) {
            Notification::send($patient, new AppoinmentStatusConfirmNotification($event->appoinment));
        } else {
            Notification::send($patient, new AppoinmentStatusCancelNotification($event->appoinment));
        }

    }
}
