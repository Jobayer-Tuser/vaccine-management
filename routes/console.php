<?php

use App\Services\VaccineControlServices;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function (){

    $vaccineControl = new VaccineControlServices();
    $vaccineControl->distributeAndScheduleUser();

});
