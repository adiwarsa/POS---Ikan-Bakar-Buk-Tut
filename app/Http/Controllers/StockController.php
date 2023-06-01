<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
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
            $stock = Stock::latest()->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'DESC')->paginate();
        } else if ($start_date) {
            $stock = Stock::latest()->whereDate('created_at', $start_date)->orderBy('created_at', 'DESC')->paginate();
        } else {
            $stock = Stock::latest()->orderBy('created_at', 'DESC')->paginate();
        }
        
		return view('stock.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock = new Stock();
		return view('stock.create', compact('stock'));
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
			'name' => 'required|string',
            'qtytype' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'limits' => 'required|integer',
            'code' => 'required|string',
            'type' => 'required|string',
		]);

        $data['qty'] = $data['qtytype'] * $data['limits'];

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('stock', $fileName, 'public');
    
            $data['image'] = $fileName;
            }
            
            $data['image'] = '';

            Stock::create($data);

		return to_route('stock.index')->withSuccess('Stock berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stock.index', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stock.edit', compact('stock'));
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
        $stock = Stock::findOrFail($id);

        $data['code'] = $request->code;
        $data['name'] = $request->name;
        $data['qty'] = $request->qty;
        
        $data['limits'] = $request->limits;
        $data['type'] = $request->type;

        $qty = $request->qty;
        $limits = $request->limits;

        if ($qty < $limits) {
            // $qtytype = 0;
            $qtytype = $qty / $limits;
        } else {
            $qtytype = $qty / $limits;
            $qtytypeRemainder = $qty % $limits;
            if ($qtytypeRemainder > 0) {
                $qtytype += 1;
            }
        }

        $data['qtytype'] = $qtytype;
        
        if($request->file('image')){
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('stock', $fileName, 'public');

        $data['image'] = $fileName;
        }

        $stock->update($data);

        return to_route('stock.index')->withSuccess('Data stock berhasil dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return to_route('stock.index')->withSuccess('Data stock berhasil dihapus.');
    }
}
