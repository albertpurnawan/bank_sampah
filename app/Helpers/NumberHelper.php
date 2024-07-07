<?php

namespace App\Helpers;

class NumberHelper
{
    public static function terbilang($number)
    {
        $number = abs($number);
        $words = [
            "", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
        ];

        $temp = "";
        if ($number < 12) {
            $temp = " " . $words[$number];
        } elseif ($number < 20) {
            $temp = self::terbilang($number - 10) . " belas";
        } elseif ($number < 100) {
            $temp = self::terbilang($number / 10) . " puluh" . self::terbilang($number % 10);
        } elseif ($number < 200) {
            $temp = " seratus" . self::terbilang($number - 100);
        } elseif ($number < 1000) {
            $temp = self::terbilang($number / 100) . " ratus" . self::terbilang($number % 100);
        } elseif ($number < 2000) {
            $temp = " seribu" . self::terbilang($number - 1000);
        } elseif ($number < 1000000) {
            $temp = self::terbilang($number / 1000) . " ribu" . self::terbilang($number % 1000);
        } elseif ($number < 1000000000) {
            $temp = self::terbilang($number / 1000000) . " juta" . self::terbilang($number % 1000000);
        } elseif ($number < 1000000000000) {
            $temp = self::terbilang($number / 1000000000) . " milyar" . self::terbilang(fmod($number, 1000000000));
        } elseif ($number < 1000000000000000) {
            $temp = self::terbilang($number / 1000000000000) . " trilyun" . self::terbilang(fmod($number, 1000000000000));
        }

        return $temp;
    }
}
