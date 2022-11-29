<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toyota;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Validator;

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
        
        $datas = Toyota::where('namamobil', 'LIKE', '%'.$keyword.'%')
        ->orderBy('namamobil','asc')
        // ->orwhere('gelar', 'LIKE', '%'.$keyword.'%')
        // ->orwhere('nip', 'LIKE', '%'.$keyword.'%')
        ->paginate(3); //Menampilkan hanya 5 data di satu halaman
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

        // // dd($request->all());
        // //Jika tidak menggunakan function postgre
        // $model = new Toyota;
        // $model->namamobil=$request->namamobil;
        // $model->hargabeli=$request->hargabeli;
        // $model->hargajual=$request->hargajual;
        // $model->stok=$request->stok;
        
        $namamobil=$request->namamobil;
        $hargabeli=$request->hargabeli;
        $hargajual=$request->hargajual;
        $stok=$request->stok;

        if($request->file('foto')){
            $file = $request->file('foto');
            $size_file = $file->getsize();
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            // $model->foto = $nama_file;
        }

        // echo $namamobil;

        if($size_file < 100000){
            $all = DB::select("select public.insertcar('$namamobil', $hargabeli, $hargajual, $stok, '$nama_file')"); //Menggunakan function di postgre
            $file->move('foto', $nama_file);
            // $model->save(); //Jika tidak menggunakan function postgre
            // dd($runQuery);
            return redirect('toyota')->with('success', 'Data berhasil disimpan');
        }else{
            return redirect('toyota')->with('failed', 'Data gagal disimpan! Ukuran file terlalu besar (Max 100 Kb)');
        }
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
        
        $model = Toyota::find($id);
        $model->namamobil=$request->namamobil;
        $model->hargabeli=$request->hargabeli;
        $model->hargajual=$request->hargajual;
        $model->stok=$request->stok;

        if($request->file('foto')){
        
            $file = $request->file('foto');
            if(!empty($file)){
                $size_file = $file->getsize();
            }
            $nama_file = time().str_replace(" ", "", $file->getClientOriginalName());
            $file->move('foto', $nama_file);

        }

        if(!empty($file)){
            // dd($size_file);
            if($size_file < 100000 ){
                File::delete('foto/'.$model->foto);
                $model->foto = $nama_file;
                $model->save();
                return redirect('toyota')->with('success', 'Data berhasil diperbarui');
            }else{
                return redirect('toyota')->with('failed', 'Data gagal disimpan! Ukuran file terlalu besar (Max 100 Kb)');
            }
        }else{
            $model->save();
            return redirect('toyota')->with('success', 'Data berhasil diperbarui');
        }
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
        return redirect('toyota')->with('success', 'Data berhasil dihapus');
    }
}
