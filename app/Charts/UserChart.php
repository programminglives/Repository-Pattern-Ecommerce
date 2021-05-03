<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Helpers\ListHelper;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class UserChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $userCountMonth = ListHelper::getModelCountUpto(User::class,30);
        $userCountWeek = ListHelper::getModelCountUpto(User::class,7);
        $userCountNow = ListHelper::getModelCountUpto(User::class);
        return Chartisan::build()
            ->labels(['30 Days Ago', '7 Days Ago', 'Today'])
            ->dataset('User', [$userCountMonth, $userCountWeek, $userCountNow]);
    }
}
