<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toyota;
use Illuminate\Support\Facades\File;

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
        // $datas = Toyota::all();
        
        $datas = Toyota::where('namaMobil', 'LIKE', '%'.$keyword.'%')
        ->orderBy('namaMobil','asc')
        // ->orwhere('gelar', 'LIKE', '%'.$keyword.'%')
        // ->orwhere('nip', 'LIKE', '%'.$keyword.'%')
        ->paginate(3); //Menampilkan hanya 5 data di satu halaman
        // $datas->withpath('pegawai');
        // ->get(); //Jika tidak menggunakan paginate
        return view('toyota.index', compact('datas', 'keyword'));
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
        
        $model = Toyota::find($id);
        $model->namaMobil=$request->namaMobil;
        $model->hargaBeli=$request->hargaBeli;
        $model->hargaJual=$request->hargaJual;
        $model->stok=$request->stok;

        if($request->file('foto')){
            $file = $request->file('foto');
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            $file->move('foto', $nama_file);

            File::delete('foto/'.$model->foto);
            $model->foto = $nama_file;
        }
        $model->save();

        return redirect('toyota')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Toyota::find($id);
        File::delete('foto/'.$model->foto);
        $model->delete();
        return redirect('toyota');
    }
}
