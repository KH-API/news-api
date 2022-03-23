<?php

namespace App\Observers;

use App\Models\Province;

class ProvinceObserver
{
    /**
     * Handle the Province "created" event.
     *
     * @param  \App\Models\Province  $province
     * @return void
     */
    public function created(Province $province)
    {
        $province->update(['parent_id' => $province->id]);
    }

    /**
     * Handle the Province "updated" event.
     *
     * @param  \App\Models\Province  $province
     * @return void
     */
    public function updated(Province $province)
    {
        //
    }

    /**
     * Handle the Province "deleted" event.
     *
     * @param  \App\Models\Province  $province
     * @return void
     */
    public function deleted(Province $province)
    {
        //
    }

    /**
     * Handle the Province "restored" event.
     *
     * @param  \App\Models\Province  $province
     * @return void
     */
    public function restored(Province $province)
    {
        //
    }

    /**
     * Handle the Province "force deleted" event.
     *
     * @param  \App\Models\Province  $province
     * @return void
     */
    public function forceDeleted(Province $province)
    {
        //
    }
}
