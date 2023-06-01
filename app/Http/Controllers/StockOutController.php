<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $end_date = Carbon::parse($end_date)->addDays(1);
            $stockouts = StockOut::latest()->whereBetween('date_out', [$start_date, $end_date])->orderBy('date_out', 'DESC')->paginate();
        } else if ($start_date) {
            $stockouts = StockOut::latest()->whereDate('date_out', $start_date)->orderBy('date_out', 'DESC')->paginate();
        } else {
            $stockouts = StockOut::latest()->orderBy('date_out', 'DESC')->paginate();
        }
		return view('stockout.index', compact('stockouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock = Stock::all();
        $stockout = new StockOut();
		return view('stockout.create', compact('stock', 'stockout'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'qty' => 'required|integer',
		]);
        $data['id_stock'] = $request->id_stock;
        $data['id_user'] = Auth::user()->id;
        $data['date_out'] = $request->date_out;
        $data['description'] = $request->description;

        $id_stock = $request->id_stock;
        $qty = $request->qty;
        $stock = Stock::where('id', $id_stock)->first();
        $qtykg = $qty * $stock->limits;
        $data['pcs'] = $qtykg;
        $new_qty = $stock->qty - $qtykg;
        
        StockOut::create($data);
        $stock->update(['qty' => $new_qty]);

        $stockqty = $stock->qty;
        $limits = $stock->limits;
        
        if ($stockqty < $limits) {
            $qtytype = $stockqty / $limits;
        } else {
            $qtytype = floor($stockqty / $limits);
            $qtytypeRemainder = $stockqty % $limits;
            if ($qtytypeRemainder > 0) {
                $qtytype += 1;
            }
        }
        $stock->update(['qtytype' => $qtytype]);

        return to_route('stockout.index')->withSuccess('Stock Out berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stockout = StockOut::findOrFail($id);
        return view('stockout.index', compact('stockout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::all();
        $stockout = StockOut::findOrFail($id);
        return view('stockout.edit', compact('stock','stockout'));
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
        $stockout = StockOut::findOrFail($id);
        $qtystockout = $stockout->pcs;

        $data['qty'] = $request->qty;
        $data['id_stock'] = $request->id_stock;
        $data['date_out'] = $request->date_out;
        $data['description'] = $request->description;

        $stockout->update($data);

        // Get the updated qty value
        $updatedQty = $stockout->qty;
        $updatedQtykg = $updatedQty * $stockout->stock->limits;
        
        // Calculate the difference out qty
        $qtyDiff = $updatedQtykg - $qtystockout;

        // Get the corresponding Stock record
        $stock = $stockout->stock;

        // Update the stock qty value based on the qty difference
        $stock->qty -= $qtyDiff;
        $stock->save();

        $stockout->update(['pcs' => $updatedQtykg]);

        $stockqty = $stock->qty;
        $limits = $stock->limits;

        if ($stockqty < $limits) {
            $qtytype = $stockqty / $limits;
        } else {
            $qtytype = floor($stockqty / $limits);
            $qtytypeRemainder = $stockqty % $limits;
            if ($qtytypeRemainder > 0) {
                $qtytype += 1;
            }
        }
        $stock->update(['qtytype' => $qtytype]);

        return to_route('stockout.index')->withSuccess('Data stockout berhasil dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $stockout = StockOut::findOrFail($id);
        $ids = $stockout->id_stock;
        $stock = Stock::where('id', $ids)->first();
        // Update the corresponding Stock model
        $stock = $stockout->stock;
        $qtykg = $stockout->qty * $stockout->stock->limits;
        $stock->qty += $qtykg;
        $stock->save();

        $stockqty = $stock->qty;
        $limits = $stock->limits;

        if ($stockqty < $limits) {
            $qtytype = $stockqty / $limits;
        } else {
            $qtytype = floor($stockqty / $limits);
            $qtytypeRemainder = $stockqty % $limits;
            if ($qtytypeRemainder > 0) {
                $qtytype += 1;
            }
        }
        $stock->update(['qtytype' => $qtytype]);

        $stockout->delete();
        return to_route('stockout.index')->withSuccess('Data stock out berhasil dihapus.');
    }
}
