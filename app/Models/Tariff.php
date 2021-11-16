<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    public $timestamps = false;

    public $begin_date;
    public $end_date;

    protected $fillable = [
        'id',
        'price',
        'begin_date',
        'end_date'
    ];

    public function dateTime($month)
    {

        $dateTime = new DateTime();
        $dateTime->customMonth($month);

        $this->begin_date = $dateTime->customBeginDate;
        $this->end_date = $dateTime->customEndDate;

    }


}
