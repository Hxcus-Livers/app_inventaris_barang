<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('depreciation:increment-month')
    ->daily() // Run daily to check for any records that need updating
    ->at('00:01'); // Run at 00:01 AM