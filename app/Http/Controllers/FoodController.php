<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food = Menu::latest()->get();
		return view('food.index', compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock = Stock::all();
        $food = new Menu();
		return view('food.create', compact('stock', 'food'));
    }

    public function createdrink()
    {
        $stock = Stock::all();
        $food = new Menu();
		return view('food.createdrink', compact('stock', 'food'));
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
            'needqty' => 'required|integer',
            'name' => 'required|string',
		]);
        $data['id_stock'] = $request->id_stock;
        $data['price'] = $request->price;
        $data['jenis'] = $request->jenis;
        $data['for'] = $request->for;
        $data['type'] = $request->type;
        
        Menu::create($data);

        $message = $data['type'] == 'makanan' ? 'Food berhasil ditambahkan.' : 'Drink berhasil ditambahkan.';

        return redirect()->route('food.index')->withSuccess($message);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Menu::findOrFail($id);
        return view('food.index', compact('food'));
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
        $food = Menu::findOrFail($id);
        return view('food.edit', compact('stock','food'));
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
        $food = Menu::findOrFail($id);
        $data['name'] = $request->name;
        $data['needqty'] = $request->needqty;
        $data['id_stock'] = $request->id_stock;
        $data['price'] = $request->price;
        $data['jenis'] = $request->jenis;
        $data['for'] = $request->for;

        $type = $food->type;
        $food->update($data);
        $message = $type == 'makanan' ? 'Food berhasil dirubah.' : 'Drink berhasil dirubah.';

        return redirect()->route('food.index')->withSuccess($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $food = Menu::findOrFail($id);
        $food->delete();
        return to_route('food.index')->withSuccess('Data food berhasil dihapus.');
    }
}
