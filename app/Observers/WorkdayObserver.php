<?php

namespace App\Observers;

use App\Models\Workday;

class WorkdayObserver
{
    /**
     * Handle the Workday "created" event.
     *
     * @param  \App\Models\Workday  $workday
     * @return void
     */
    public function created(Workday $workday)
    {
        //
    }

    /**
     * Handle the Workday "updated" event.
     *
     * @param  \App\Models\Workday  $workday
     * @return void
     */
    public function updating(Workday $workday)
    {
       if($workday->morning_start>$workday->morning_end){$workday->morning_start=13; $workday->morning_end=13;}
       if($workday->afternoon_start>$workday->afternoon_end){$workday->afternoon_start=25; $workday->afternoon_end=25;}
       if($workday->evening_start>$workday->evening_end){$workday->evening_start=37; $workday->evening_end=37;}

    }

    /**
     * Handle the Workday "deleted" event.
     *
     * @param  \App\Models\Workday  $workday
     * @return void
     */
    public function deleted(Workday $workday)
    {
        //
    }

    /**
     * Handle the Workday "restored" event.
     *
     * @param  \App\Models\Workday  $workday
     * @return void
     */
    public function restored(Workday $workday)
    {
        //
    }

    /**
     * Handle the Workday "force deleted" event.
     *
     * @param  \App\Models\Workday  $workday
     * @return void
     */
    public function forceDeleted(Workday $workday)
    {
        //
    }
}
