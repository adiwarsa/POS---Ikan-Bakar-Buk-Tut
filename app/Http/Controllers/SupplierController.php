<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Mengambil data supplier terbaru berdasarkan created_at
        $supplier = Supplier::orderByDesc('created_at')->get();
		return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Mendefinisikan Model Supplier
        $supplier = new Supplier();
		return view('supplier.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Request input dengan validasi
        $data = $request->validate([
			'nama' => 'required|string',
            'telp' => 'required|string',
		]);
        //Store request input ke dalam database
        Supplier::create($data);

		return to_route('supplier.index')->withSuccess('Supplier berhasil ditambahkan.');
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
        //Mengambil data supplier berdasarkan id
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
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
        //Mengambil data supplier berdasarkan id
        $supplier = Supplier::findOrFail($id);
        //Request input data supplier
        $data['nama'] = $request->nama;
        $data['telp'] = $request->telp;
        
        //update data supplier yang diubah
        $supplier->update($data);

        return to_route('supplier.index')->withSuccess('Data supplier berhasil dirubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
         //Mengambil data supplier berdasarkan id
         $supplier = Supplier::findOrFail($id);
         //Menghapus data supplier yang diambil
         $supplier->delete();
         return to_route('supplier.index')->withSuccess('Data supplier berhasil dihapus.');
    }
}
