<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;

    public $fillable = [
        'id',
        'resident_id',
        'period_id',
        'amount_rub'
    ];

    public function period()
	{
		return $this->belongsTo(Period::class);
	}

	public function resident()
	{
		return $this->belongsTo(Resident::class);
	}

}
