<?php

use Carbon\Carbon;
if (function_exists('currency_IDR'))
{
    function currency_IDR($value) 
    {
        return "Rp. " . number_format($value,0, ',', '.');
    }
}

class Helpers 
{
 public static function format_date($value) {
     return Carbon::parse($value)->format("M Y");
 }
}
