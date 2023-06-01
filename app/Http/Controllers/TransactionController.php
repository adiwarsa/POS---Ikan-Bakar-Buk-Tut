<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class TransactionController extends Controller
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
            $transaction = Transaction::latest()->whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'DESC')->paginate();
            $total = $transaction->sum('total_price');
        } else if ($start_date) {
            $transaction = Transaction::latest()->whereDate('created_at', $start_date)->orderBy('created_at', 'DESC')->paginate();
            $total = $transaction->sum('total_price');
        } else {
            $transaction = Transaction::latest()->orderBy('created_at', 'DESC')->paginate();
            $total = $transaction->sum('total_price');
        }
		return view('transaction.index', compact('transaction', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::where('for', 'Non Paket')->get();
        $paket = Paket::all();
        $transaction = new Transaction();
        return view('transaction.create', compact('paket', 'menu', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transactionNumber = 'TR' . now()->format('d') . Str::random(3) . now()->format('M') . Str::random(3) . now()->format('Y');
        $transaction = Transaction::create([
            'id_user' => Auth::user()->id,
            'code' => strtoupper($transactionNumber),
            'name' => $request->input('name'),
            'total_price' => 0,
            'pay' => $request->pay,
        ]);
        if ($request->has('menu_id')) {
            foreach ($request->input('menu_id') as $menuId) {
                $menu = Menu::findOrFail($menuId);
                $qty = $request->input('menu_qty')[$menuId];
                $detailTransaction = $transaction->detailTransactions()->create([
                    'menu_id' => $menu->id,
                    'qty' => $qty,
                    'price' => $menu->price * $qty
                ]);
                $id_stock = $menu->id_stock;
                $stock = Stock::where('id', $id_stock)->first();
                // Update the menu stock
                $qtystock = $menu->needqty * $qty;
                $stock->qty -= $qtystock;
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
            }
        }
        
        if ($request->has('paket_id')) {
            foreach ($request->input('paket_id') as $paketId) {
                $paket = Paket::findOrFail($paketId);
                $detailTransaction = $transaction->detailTransactions()->create([
                    'paket_id' => $paket->id,
                    'qty' => $request->input('paket_qty')[$paketId],
                    'price' => $paket->price * $request->input('paket_qty')[$paketId]
                ]);
                foreach ($paket->foods as $menu) {
                    $pivot = $paket->foods()->where('menu_id', $menu->id)->first()->pivot;
                    $totalQty = $pivot->qty * $request->input('paket_qty')[$paketId];
                    $qtystock = $menu->needqty * $totalQty;
                    $menu->stock->qty -= $qtystock;
                    $menu->stock->save();

                    $stockqty = $menu->stock->qty;
                    $limits = $menu->stock->limits;

                    if ($stockqty < $limits) {
                        $qtytype = $stockqty / $limits;
                    } else {
                        $qtytype = floor($stockqty / $limits);
                        $qtytypeRemainder = $stockqty % $limits;
                        if ($qtytypeRemainder > 0) {
                            $qtytype += 1;
                        }
                    }
                    $menu->stock->update(['qtytype' => $qtytype]);
                }
            }
        }
        
        // Calculate total price based on detail transaction
        $totalPrice = $transaction->menus->sum('pivot.price') + $transaction->pakets->sum('pivot.price');
        
        // Update total price in transaction
        $transaction->total_price = $totalPrice;
        $transaction->save();
        
        $id = $transaction->id;

        return to_route('transaction.print',['id' => $id]);
        // return to_route('transaction.index')->withSuccess('Data transaction berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function print($id)
    {
        $transaction = Transaction::findOrFail($id);
        $kembalian = $transaction->pay - $transaction->total_price;
        return view('transaction.print', compact('transaction', 'kembalian'));
    }

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
    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return to_route('transaction.index')->withSuccess('Data transaction berhasil dihapus.');
    }
}
