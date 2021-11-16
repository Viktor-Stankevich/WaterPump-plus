<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PumpMeteRecords extends Model
{

    protected $table = 'pump_meter_records';

    public $timestamps = false;

    public $fillable = [
        'period_id',
        'amount_volume',
    ];

    public function period()
    {
        return hasOne(Period::class);
    }
}
