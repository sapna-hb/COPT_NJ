<?php

use App\Models\Therapy;
use App\Models\Treatment;

function howWeTreat()
{
    $therapies = Therapy::where('is_active', 1)->where('is_deleted', 0)->get();

    return $therapies;
}


function whatWeTreat()
{
    $treatments = Treatment::where('is_active', 1)->where('is_deleted', 0)->get(['treatment_name']);

    return $treatments;
}
