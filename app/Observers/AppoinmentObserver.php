<?php

namespace App\Observers;

use App\Models\Appoinment;

class AppoinmentObserver
{
    /**
     * Handle the Appoinment "created" event.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return void
     */
    public function created(Appoinment $appoinment)
    {
        $appoinment->status = Appoinment::PENDING;
        $appoinment->save();

    }



    /**
     * Handle the Appoinment "updated" event.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return void
     */
    public function updated(Appoinment $appoinment)
    {
        //
    }

    /**
     * Handle the Appoinment "deleted" event.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return void
     */
    public function deleted(Appoinment $appoinment)
    {
        //
    }

    /**
     * Handle the Appoinment "restored" event.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return void
     */
    public function restored(Appoinment $appoinment)
    {
        //
    }

    /**
     * Handle the Appoinment "force deleted" event.
     *
     * @param  \App\Models\Appoinment  $appoinment
     * @return void
     */
    public function forceDeleted(Appoinment $appoinment)
    {
        //
    }
}
