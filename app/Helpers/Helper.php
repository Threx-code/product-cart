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

    /**
     * @param string $productName
     * @return string
     */
    public static function productNameFormatter(string $productName): string
    {
        return ucwords($productName);
    }

}
