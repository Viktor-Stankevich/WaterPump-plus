<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Period;
use App\Models\Bill;

class BillController extends Controller
{
    public function showBill(Request $request)
    {
        $periods = Period::where('begin_date', $request->month)->get();

        foreach ($periods as $period)
        {
            $bills = Bill::where('period_id', $period->id)->get();
            $bills->load('resident', 'period');
            return $bills;
        }

    }
}
