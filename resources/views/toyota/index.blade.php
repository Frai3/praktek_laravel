@extends('layouts.index')

@section('content')
    <br />
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif

    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupInsert">Tambah</a>
    <br /><br />

    <br />
    <table class="table table-bordered">
        <tr>
            <th>Foto Mobil</th>
            <th>Nama Mobil</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th colspan="2">Aksi</th>
        </tr>
        @foreach($datas as $key=>$value)
            <tr>
                <td>
                    <img src="{{ asset('foto/'.$value->foto) }}" alt="" width="250px">
                </td>
                <td>{{$value->namaMobil}}</td>
                <td>{{$value->hargaBeli}}</td>
                <td>{{$value->hargaJual}}</td>
                <td>{{$value->stok}}</td>
                <td>
                    <a class="btn btn-warning" href="{{ url('toyota/'.$value->id.'/edit ') }}">Update</a>
                </td>
                <td>
                    <form action="{{ url('toyota/'.$value->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div id="popupInsert" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data Kendaraan</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    Nama Mobil : <input type="text" name="namaMobil" class="form-control"><br />
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection