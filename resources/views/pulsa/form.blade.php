<x-modal data-backdrop="static" data-keyboard="false" size="modal-md">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="provider">Provider <span class="text-danger">*</span> </label>
                <select name="provider" id="provider" class="select2"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="text" name="nominal" class="form-control" id="nominal" autocomplete="off"
                    placeholder="example : 5000" onkeyup="format_uang(this)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="harga_beli">Harga Beli</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="harga_beli" class="form-control" id="harga_beli" autocomplete="off"
                    min="0" onkeyup="format_uang(this)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <label for="harga_jual">Harga Jual</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="harga_jual" class="form-control" id="harga_jual" autocomplete="off"
                    min="0" onkeyup="format_uang(this)">
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
