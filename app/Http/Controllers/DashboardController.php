<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlahuser = User::all()->count();
        $jumlahstock = Stock::all()->count();
        $jumlahstockin = StockIn::all()->count();
        $jumlahstockout = StockOut::all()->count();
        $sekarang = Carbon::now()->locale('id');
        $sekarang->settings(['formatFunction' => 'translatedFormat']);

        $sinmonth = StockIn::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $soutmonth = StockOut::where('created_at', '>=', Carbon::now()->subMonth())->count();
        return view('home', compact('jumlahstock','jumlahstockin','jumlahstockout','jumlahuser', 'sekarang','sinmonth','soutmonth'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
