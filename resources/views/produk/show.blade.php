<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg" class="modal-detail">
    <x-slot name="title">
        Detail
    </x-slot>

    <table class="table table-bordered" style="width: 100%">
        <tr>
            <th>Nama Produk</th>
            <th>:</th>
            <td id="nama_produk"></td>
        </tr>
        <tr>
            <th>Provider</th>
            <th>:</th>
            <td id="nama_provider"></td>
        </tr>
        <tr>
            <th>Harga Beli</th>
            <th>:</th>
            <td id="harga_beli"></td>
        </tr>
        <tr>
            <th>Harga Jual</th>
            <th>:</th>
            <td id="harga_jual"></td>
        </tr>
        <tr>
            <th>Stok</th>
            <th>:</th>
            <td id="stok"></td>
        </tr>
        <tr>
            <th>Keuntungan</th>
            <th>:</th>
            <td id="laba"></td>
        </tr>
    </table>

    <x-slot name="footer">
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
