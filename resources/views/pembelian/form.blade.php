<x-modal data-backdrop="static" data-keyboard="false" size="modal-md">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label for="type_transaksi">Jenis Transaksi</label>
                <select name="type" id="opsiPilihan" class="custom-select" onchange="toggleInput()">
                    <option disabled selected>Pilih Transaksi</option>
                    <option value="pulsa">Pulsa</option>
                    <option value="vocer">Vocer</option>
                    <option value="lainya">Lainnya</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="Inputpulsa" style="display: none">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="pulsa">Pilih jenis pulsa <span class="text-danger">*</span> </label>
                <select name="pulsa" id="pulsa" class="select2"></select>
            </div>
        </div>
    </div>
    <div id="pulsaInput" style="display: none;" class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="saldo">Saldo <span class="text-danger">*</span> </label>
                <input type="text" name="saldo_pulsa" class="form-control" id="saldo" autocomplete="off"
                    onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    <div id="hargaPulsa" style="display: none;" class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="harga_pulsa">Harga Pulsa <span class="text-danger">*</span> </label>
                <input type="text" name="harga_pulsa" class="form-control" id="harga_pulsa" autocomplete="off"
                    onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    {{--  Vocer  --}}
    <div class="row" id="produk" style="display: none">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="vocer">Pilih Vocer <span class="text-danger">*</span> </label>
                <select name="vocer" id="vocer" class="select2"></select>
            </div>
        </div>
    </div>

    <div class="row" id="harga" style="display: none">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="harga">Harga <span class="text-danger">*</span> </label>
                <input type="text" name="harga" class="form-control" id="harga" autocomplete="off"
                    onkeyup="format_uang(this)">
            </div>
        </div>
    </div>

    <div class="row" id="jumlahPembelian" style="display: none">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="vocer">Jumlah <span class="text-danger">*</span> </label>
                <input type="number" name="jumlah_pembelian" class="form-control" id="jumlah_pembelian"
                    autocomplete="off">
            </div>
        </div>
    </div>
    {{--  End Vocer  --}}

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
