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
     * Number of days to be shown in the chart
     * @var int
     */
    private $days = 30;

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $labels = [];
        $dataset = [];
        for ($this->days; $this->days > 0; $this->days--){
            array_push($labels,$this->days);
            array_push($dataset,ListHelper::getModelCountOnDay(User::class,$this->days));
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('User', $dataset);
    }
}
