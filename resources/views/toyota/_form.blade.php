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