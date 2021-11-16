<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'begin_date',
        'end_date',
    ];

    public function createPeriod($date)
    {
        $dateTime = new DateTime();
        $dateTime->period($date);
        $this->begin_date = $dateTime->periodBeginDate;
        $this->end_date = $dateTime->periodEndDate;
        $this->save();
    }

    public function updatePeriod($date)
    {
        $dateTime = new DateTime();
        $dateTime->period($date);
        $this->begin_date = $dateTime->periodBeginDate;
        $this->end_date = $dateTime->periodEndDate;
        $this->update();
    }

    public function bills()
	{
		return $this->hasMany(Bill::class);
	}

    public function counter()
    {
        return $this->hasOne(Counter::class);
    }
}
