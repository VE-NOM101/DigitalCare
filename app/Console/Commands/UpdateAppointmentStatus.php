<?php

namespace App\Console\Commands;

use App\Models\RequestedAppointment;
use Illuminate\Console\Command;

class UpdateAppointmentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:update_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the RequestedAppointments table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //It will update the isConfirmed to 2 if the preferred date is lessthan current date.. cause it
        //it's the request for all previous request
        $requested_appointment = RequestedAppointment::where('preferred_date','<',today())->get();
        foreach ($requested_appointment as $appointment) {
            $appointment->isConfirmed = 2;
            $appointment->save();
        }
    }
}
