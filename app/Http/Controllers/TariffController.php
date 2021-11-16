<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = new Carbon('first day of last month');
        $date->startOfMonth();

        $tariffs = Tariff::all();

        return Tariff::where('begin_date', '>=', $date)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'price' => ['required'],
            'month' => ['required'],
        ]);


        $model = new Tariff();
        $model->dateTime($request->month);

        $date = new Carbon('first day of last month');
        $date->startOfMonth();

        if($model->begin_date < $date)
        {
            return [
                'status' => false
            ];
        } else {
            Tariff::create([
                'price' => $request->price,
                'begin_date' => $model->begin_date,
                'end_date' => $model->end_date
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function edit(Tariff $tariff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tariff $tariff)
    {
        $request->validate([
            'price' => ['required'],
            'month' => ['required'],
        ]);

        $model = new Tariff();
        $model->dateTime($request->month);

        $date = new Carbon('first day of last month');
        $date->startOfMonth();

        if($model->begin_date < $date )
        {
            return [
                'status' => false
            ];
        } else {
            Tariff::where('id', $tariff->id)->update([
                'price' => $request->price,
                'begin_date' => $model->begin_date,
                'end_date' => $model->end_date
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();
    }
}
