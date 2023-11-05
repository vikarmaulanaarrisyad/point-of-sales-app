<x-modal data-backdrop="static" data-keyboard="false" size="modal-md">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="keterangan">Deskripsi Pengeluaran <span class="text-danger">*</span> </label>
                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3" autocomplete="off"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="total_pengeluaran">Nominal</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="total_pengeluaran" class="form-control" id="total_pengeluaran"
                    autocomplete="off" min="0" onkeyup="format_uang(this)">
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
