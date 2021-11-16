<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DateTime extends Model
{

    public $periodBeginDate;
    public $periodEndDate;
    public $customBeginDate;
    public $customEndDate;

    public function lastMonth()
    {
        $lastMonth = new Carbon('first day of last month');
        $lastMonth->startOfMonth();
    }

    public function customMonth($month)
    {
        $beginDate = Carbon::createFromDate(null, $month, null);
        $endDate = Carbon::createFromDate(null, $month, null);
        $this->customBeginDate = $beginDate->startOfMonth();
        $this->customEndDate = $endDate->endOfMonth();
    }

    public function period($date)
    {
        if(is_string($date))
        {
            $begin_date = new Carbon('first day of ' . $date . ' month');
            $end_date = new Carbon('last day of ' .  $date . ' month');
            $begin_date->startOfMonth();
            $end_date->endOfMonth();
            $this->periodBeginDate = $begin_date;
            $this->periodEndDate = $end_date;
        } else {
            $this->periodBeginDate = $date['begin_date'];
            $this->periodEndDate = $date['end_date'];
        }

    }

}
