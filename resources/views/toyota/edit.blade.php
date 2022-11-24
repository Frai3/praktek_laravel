@extends('layouts.index')

@section('content')
    <br />

    <form action="{{ url('toyota/'.$model->id) }}" method="POST" enctype="multipart/form-data">
    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupInsert">Tambah</a>

        <div id="popupInsert" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Kendaraan</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        Nama Mobil : <input type="text" name="namaMobil" class="form-control" value="{{ $model->namaMobil }}"><br />
                        Harga Beli : <input type="number" name="hargaBeli" class="form-control"><br />
                        Harga Jual : <input type="number" name="hargaJual" class="form-control"><br />
                        Stok : <input type="number" name="stok" class="form-control"><br />
                        Foto : <input type="file" name="foto" class="form-control"><br />
                        <button type="submit" class="btn btn-primary" >SIMPAN</button>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection