<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class Helper
{
    /**
     * @return Carbon
     */
    public static function dateFormatter(): Carbon
    {
        return Carbon::now();
    }

}
