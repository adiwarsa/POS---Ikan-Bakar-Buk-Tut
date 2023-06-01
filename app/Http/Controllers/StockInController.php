<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockIn;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\SupportsBasicAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInController extends Controller
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
            $stock = StockIn::latest()->whereBetween('date_in', [$start_date, $end_date])->orderBy('date_in', 'DESC')->paginate();
            $total = $stock->sum('total_price');
        } else if ($start_date) {
            $stock = StockIn::latest()->whereDate('date_in', $start_date)->orderBy('date_in', 'DESC')->paginate();
            $total = $stock->sum('total_price');
        } else {
            $stock = StockIn::latest()->orderBy('date_in', 'DESC')->paginate();
            $total = $stock->sum('total_price');
        }
		return view('stockin.index', compact('stock', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock = Stock::all();
        $supplier = Supplier::all();
        $stockin = new StockIn();
		return view('stockin.create', compact('stock', 'stockin','supplier'));
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

        $data['id_supplier']= $request->id_supplier;
        $data['id_user'] = Auth::user()->id;
        $data['id_stock'] = $request->id_stock;
        $data['date_in'] = $request->date_in;
        $data['price'] = $request->price;
        $data['total_price'] = $request->qty * $request->price;

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('stockin', $fileName, 'public');

        $data['file'] = $fileName;

        $id_stock = $request->id_stock;
        $qty = $request->qty;
        $stock = Stock::where('id', $id_stock)->first();
        $qtykg = $qty * $stock->limits;
        $data['pcs'] = $qtykg;
        $new_qty = $stock->qty + $qtykg;
        
        $stockin = StockIn::create($data);

        $stockin->update([
            'supplier' => $stockin->suppliers->nama,
            'telp_supplier' => $stockin->suppliers->telp,
        ]);

        $stock->update(['qty' => $new_qty]);

        $stockqty = $stock->qty;
        $limits = $stock->limits;

        if ($stockqty <= $limits) {
            $qtytype = 0;
        } else {
            $qtytype = floor($stockqty / $limits);
            $qtytypeRemainder = $stockqty % $limits;
            if ($qtytypeRemainder > 0 ) {
                $qtytype += 1;
            }
        }
        $stock->update(['qtytype' => $qtytype]);
        
        return to_route('stockin.index')->withSuccess('Stock In berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = StockIn::findOrFail($id);
        return view('stockin.index', compact('stock'));
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
        $supplier = Supplier::all();
        $stockin = StockIn::findOrFail($id);
        return view('stockin.edit', compact('stock','stockin','supplier'));
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
        $stockin = StockIn::findOrFail($id);
        $qtystock = $stockin->pcs;
        
        $data['qty'] = $request->qty;
        $data['id_stock'] = $request->id_stock;
        $data['id_supplier'] = $request->id_supplier;
        $data['date_in'] = $request->date_in;
        $data['price'] = $request->price;
        $data['total_price'] = $request->qty * $request->price;

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('stockin', $fileName, 'public');
    
            $data['file'] = $fileName;
            }
    
            $stockin->update($data);

            // Get the updated qty value
            $updatedQty = $stockin->qty;
            $updatedQtykg = $updatedQty * $stockin->stock->limits;

            // Calculate the difference in qty
            $qtyDiff = $updatedQtykg - $qtystock;

            // Get the corresponding Stock record
            $stock = $stockin->stock;

            // Update the stock qty value based on the qty difference
            $stock->qty += $qtyDiff;
            $stock->save();

            $stockin->update([
                'pcs' => $updatedQtykg,
                'supplier' => $stockin->suppliers->nama,
                'telp_supplier' => $stockin->suppliers->telp,
            ]);

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
            return to_route('stockin.index')->withSuccess('Data stockin berhasil dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
        $stockin = StockIn::findOrFail($id);
        $ids = $stockin->id_stock;
        $stock = Stock::where('id', $ids)->first();
        // Update the corresponding Stock model
        $stock = $stockin->stock;
        $qtykg = $stockin->qty * $stockin->stock->limits;
        $stock->qty -= $qtykg;
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

        $stockin->delete();
        return to_route('stockin.index')->withSuccess('Data stock in berhasil dihapus.');
    }
}
