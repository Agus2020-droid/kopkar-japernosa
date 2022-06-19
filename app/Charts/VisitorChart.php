<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class VisitorChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public ?string $name = 'VisitorChart';
    public ?string $routeName = 'chart';
    // public ?string $prefix = 'some_prefix';
    public ?array $middlewares = ['auth'];
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar'])
            ->dataset('Sales', [1, 2, 3])
            ->dataset('Order', [3, 2, 1]);
    }
}