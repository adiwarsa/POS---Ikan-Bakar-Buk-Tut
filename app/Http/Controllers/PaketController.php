<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pakets = Paket::with('foods.stock')->latest()->paginate();
		return view('paket.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::where('for', 'Paket')->get();
        $paket = new Paket();
        return view('paket.create', compact('paket', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paket = Paket::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);
        
        $menu = $request->input('menu');
        $quantities = $request->input('quantity');
        
        foreach ($menu as $menuId) {
            if (isset($quantities[$menuId]) && $quantities[$menuId] > 0) {
                $paket->foods()->attach($menuId, ['qty' => $quantities[$menuId]]);
            }
        }

        return to_route('paket.index')->withSuccess('Paket berhasil ditambahkan.');
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
    public function delete($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        return to_route('paket.index')->withSuccess('Data paket berhasil dihapus.');
    }
}
