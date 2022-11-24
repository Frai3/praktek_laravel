<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toyota;

class ToyotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $datas = Toyota::all();
        return view('toyota.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Toyota;
        return view('toyota.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $model = new Toyota;
        $model->namaMobil=$request->namaMobil;
        $model->hargaBeli=$request->hargaBeli;
        $model->hargaJual=$request->hargaJual;
        $model->stok=$request->stok;

        if($request->file('foto')){
            $file = $request->file('foto');
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            $file->move('foto', $nama_file);
            $model->foto = $nama_file;
        }
        $model->save();

        return redirect('toyota')->with('success', 'Data berhasil disimpan');
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
        $model = Toyota::find($id);
        return view('toyota.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $namaMobil)
    {
        
        dd($request->all());
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
