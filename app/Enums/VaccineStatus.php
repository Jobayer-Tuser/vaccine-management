<?php

namespace App\Enums;

enum VaccineStatus: string
{
    case SCHEDULED      = "Scheduled";
    case VACCINATED     = "Vaccinated";
    case NOT_REGISTERED = "Not registered";
    case NOT_SCHEDULED  = "Not scheduled";

    public function status() : string
    {
        return match($this) {
            self::SCHEDULED      => "Scheduled",
            self::VACCINATED     => "Vaccinated",
            self::NOT_REGISTERED => "Not registered",
            self::NOT_SCHEDULED  => "Not scheduled",
        };
    }
}
