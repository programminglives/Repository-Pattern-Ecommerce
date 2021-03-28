<?php

namespace App\Helpers;

class ListHelper{

    /**
     * Get row count up to x days ago
     * @param $model
     * @param int $daysAgo
     * @return mixed
     */
    public static function getModelCountUpto($model, int $daysAgo = 0){
        return $model::where('created_at', '<=', \Carbon\Carbon::now()->subDays($daysAgo)->toDateTimeString())
            ->get()->count();
    }

    /**
     * Get row count of last x days
     * @param $model
     * @param int $daysAgo
     * @return mixed
     */
    public static function getModelCountFrom($model, int $daysAgo = 0){
        return $model::where('created_at', '>=', \Carbon\Carbon::now()->subDays($daysAgo)->toDateTimeString())
            ->get()->count();
    }

    /**
     * @param int $newNumber
     * @param int $originalNumber
     * @return float|int
     */
    public static function increasePercentage(int $newNumber,int $originalNumber){
        if($originalNumber == 0)
            return 100;
        return number_format(($newNumber/$originalNumber)*100,2);
    }

}
