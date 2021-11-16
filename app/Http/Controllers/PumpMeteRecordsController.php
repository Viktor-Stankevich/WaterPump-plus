<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use App\Models\Resident;
use App\Models\PumpMeteRecords;
use App\Models\Tariff;
use App\Models\Bill;
use Carbon\Carbon;

class PumpMeteRecordsController extends Controller
{
    public function createPumpMeterRecords(Request $request)
    {
        $period = new Period();

        $request->validate([
            'amount_volume' => ['required']
        ]);

        $currentDate = new Carbon('first day of last month');
        $currentDate->startOfMonth();

        $currentTariff = Tariff::where('begin_date', $currentDate)->exists();

        if($currentTariff)
        {
            $tariffs = Tariff::where('begin_date', $currentDate)->get();

            foreach($tariffs as $tariff)
            {
                $periods = [
                    'begin_date' => $tariff['begin_date'],
                    'end_date' => $tariff['end_date'],
                ];
                $period->createPeriod($periods);

                PumpMeteRecords::create([
                    'period_id' => $period->id,
                    'amount_volume' => $request->amount_volume,
                ]);
                foreach (Resident::all() as $resident)
                {
                    $bills = Bill::get();
                    $bills->load('period');

                    $resident->bills()->create([
                        'resident_id' => $resident->id,
                        'period_id' => $period->id,
                        'amount_rub' => $resident->area * ($request->amount_volume * $tariff['price']) / $resident->sum('area')
                    ]);
                }
            }
        } else {
            $period->createPeriod('last');

            PumpMeteRecords::create([
                'period_id' => $period->id,
                'amount_volume' => $request->amount_volume,
            ]);

            foreach (Resident::all() as $resident)
            {
                $resident->bills()->create([
                    'resident_id' => $resident->id,
                    'period_id' => $period->id,
                    'amount_rub' => $resident->area * ($request->amount_volume * $request->price) / $resident->sum('area')
                ]);
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
}
