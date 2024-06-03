<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Utils
{
    public static function isNullOrEmpty($value)
    {
        if (is_null($value) || empty($value)) return true;
        else return false;
    }

    public static function isEmptyStr($value)
    {
        return $value === '';
    }

    public static function getStrMonth($month)
    {
        if ($month == 1) return "Januari";
        else if ($month == 2) return "Februari";
        else if ($month == 3) return "Maret";
        else if ($month == 4) return "April";
        else if ($month == 5) return "Mei";
        else if ($month == 6) return "Juni";
        else if ($month == 7) return "Juli";
        else if ($month == 8) return "Agustus";
        else if ($month == 9) return "September";
        else if ($month == 10) return "Oktober";
        else if ($month == 11) return "November";
        else if ($month == 12) return "Desember";
    }

    public static function getStrDateIdnFormat($date)
    {
        $y = $date->format("Y");
        $m = $date->format("n");
        $d = $date->format("j");

        return $d.' '.Utils::getStrMonth($m).' '.$y;
    }

    public static function encryptString($data)
	{
        return Crypt::encryptString($data);
	}

    public static function decryptString($data)
	{
        return Crypt::decryptString($data);
	}
}
