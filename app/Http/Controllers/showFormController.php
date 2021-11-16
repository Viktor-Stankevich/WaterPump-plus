<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Tariff;
use Carbon\Carbon;

class showFormController extends Controller
{
    public function showCalculateForm()
    {
        $currentDate = new Carbon('first day of last month');
        $currentDate->startOfMonth();

        $bills = Bill::get();
        $bills->load('period');

        foreach($bills as $bill) {

            if($bill->period->begin_date == $currentDate) {
                return [
                    'status' => true
                ];
            }
        }
    }

    public function currentPrice()
    {
        $currentDate = new Carbon('first day of last month');
        $currentDate->startOfMonth();
        $currentTariff = Tariff::where('begin_date', $currentDate)->exists();

        if($currentTariff)
        {
            $tariffs = Tariff::where('begin_date', $currentDate)->get();
            foreach($tariffs as $tariff)
            {
                return $tariff['price'];
            }
        }
    }
}
