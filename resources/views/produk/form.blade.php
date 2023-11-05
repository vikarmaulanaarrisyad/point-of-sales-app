<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="provider">Provider <span class="text-danger">*</span></label>
                <select name="provider" id="provider" class="select2"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="nama_produk">Nama Vocer <span class="text-danger">*</span> </label>
                <input type="text" name="nama_produk" class="form-control" id="nama_produk" autocomplete="off"
                    placeholder="Nama vocer">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="harga_beli">Harga Beli <span class="text-danger">*</span> </label>
                <input type="text" name="harga_beli" class="form-control" id="harga_beli" autocomplete="off"
                    min="0" onkeyup="format_uang(this)" placeholder="Harga Beli">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="harga_jual">Harga Jual <span class="text-danger">*</span> </label>
                <input type="text" name="harga_jual" class="form-control" id="harga_jual" autocomplete="off"
                    min="0" onkeyup="format_uang(this)" placeholder="Harga Jual">
            </div>
        </div>
    </div>
    <div class="row" style="display: none">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
                <label for="stok_awal">Stok Awal </label>
                <input type="number" name="stok_awal" class="form-control" id="stok_awal" autocomplete="off"
                    min="0" value="0" onkeyup="format_uang(this)" placeholder="Stok">
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-outline-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
