@extends('layouts.index')

@section('content')
    @php
        $keyword = "";
    @endphp
    <br />
    @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif

    <div class="row">
        <div class="col-3">
            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#popupInsert">Tambah</a>
            <br /><br />
        </div>
        <div class="col-5">
        </div>
        <div class="col-4">
            <form action="{{ url('toyota') }}" method="GET">
                <input type="text" name="keyword"/>
                <button type="submit">Search</button>
            </form>
        </div>
    </div>
    <br />
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Foto Mobil</th>
                <th>Nama Mobil</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateBarang{{ $value->id }}">Update</button>
                    </td>
                    <td>
                        <form action="{{ url('toyota/'.$value->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="popupInsert" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data Kendaraan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('toyota') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        Nama Mobil : <input type="text" name="namaMobil" class="form-control"><br />
                        Harga Beli : <input type="number" name="hargaBeli" class="form-control"><br />
                        Harga Jual : <input type="number" name="hargaJual" class="form-control"><br />
                        Stok : <input type="number" name="stok" class="form-control"><br />
                        Foto : <input type="file" name="foto" class="form-control"><br />
                        <button type="submit" class="btn btn-primary" >SIMPAN</button>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($datas as $key=>$value)
    <div class="modal fade" id="modalUpdateBarang{{ $value->id }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('toyota/'.$value->id) }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="_method" value="PATCH">
                        <br />
                        Nama Mobil : <input type="text" name="namaMobil" class="form-control" value="{{ $value->namaMobil }}"><br />
                        Harga Beli : <input type="number" name="hargaBeli" class="form-control" value="{{ $value->hargaBeli }}"><br />
                        Harga Jual : <input type="number" name="hargaJual" class="form-control" value="{{ $value->hargaJual }}"><br />
                        Stok : <input type="number" name="stok" class="form-control" value="{{ $value->stok }}"><br />
                        Foto : <input type="file" name="foto" class="form-control" value="{{ $value->foto }}"><br />
                        <img src="{{ asset('foto/'.$value->foto) }}" alt="" width="250px">
                        <br />
                        <br />
                        <button type="submit" class="btn btn-primary" >SIMPAN</button>
                        <br />
                        <br />
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{ $datas->links() }}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection