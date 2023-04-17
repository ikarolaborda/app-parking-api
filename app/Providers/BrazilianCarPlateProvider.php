<?php

namespace App\Providers;

use Faker\Provider\Base;

class BrazilianCarPlateProvider extends Base
{
    public function carPlate(): string
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $letterPart = substr(str_shuffle($letters), 0, 3);
        $digitPart = rand(0, 9);
        $letterAndDigitPart = substr(str_shuffle($letters), 0, 1) . rand(0, 9) . rand(0, 9);

        return $letterPart . $digitPart . $letterAndDigitPart;
    }
}
