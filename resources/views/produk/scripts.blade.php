@push('scripts')
    <script>
        let table;
        let modal = '#modal-form';
        let modalShow = '.modal-detail';
        let button = '#submitBtn';

        $(function() {
            $('#spinner-border').hide();
        });

        table = $('#produk').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            language: {
                "processing": "Mohon bersabar..."
            },
            ajax: {
                url: '{{ route('produk.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'nama_produk',
                },
                {
                    data: 'provider',
                },
                {
                    data: 'harga_beli',
                },
                {
                    data: 'harga_jual',
                },
                {
                    data: 'stok_akhir',
                },
                {
                    data: 'aksi',
                    sortable: false,
                    searchable: false
                },
            ]
        });

        function addData(url, title = 'Tambah Data Produk') {
            $(modal).modal('show');

            $(`${modal} .modal-title`).text(title);

            $(`${modal} form`).attr('action', url);

            $(`${modal} [name=_method]`).val('POST');

            $('#spinner-border').hide();

            $("#status_pemilihan").hide();

            $(button).show();

            $(button).prop('disabled', false);

            resetForm(`${modal} form`);
        }

        function editData(url, title = 'Edit Data Produk') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');

                    $(`${modal} .modal-title`).text(title);

                    $(`${modal} form`).attr('action', url);

                    $(`${modal} [name=_method]`).val('PUT');

                    $('#spinner-border').hide();

                    $(button).prop('disabled', false);

                    resetForm(`${modal} form`);

                    loopForm(response.data);

                    $('#provider').append(new Option(response.data.provider.nama_provider, response.data.provider.id,
                        true, true));
                    $('#provider').trigger('change');

                })
                .fail(errors => {
                    Swall.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                });
        }

        function detailData(url, name, title = 'Detail Data ') {
            $.get(url)
                .done(response => {
                    const nama = title + `<b>${name}</b>`;
                    $(modalShow).modal('show');
                    $(`${modalShow} .modal-title`).html(nama);
                    $(`${modalShow} #nama_produk`).text(response.nama_produk);
                    $(`${modalShow} #nama_provider`).text(response.provider.nama_provider);
                    $(`${modalShow} #harga_beli`).text(response.harga_beli);
                    $(`${modalShow} #harga_jual`).text(response.harga_jual);
                    $(`${modalShow} #stok`).text(response.stok);
                    $(`${modalShow} #laba`).text(response.laba);
                })
                .fail(errors => {
                    Swall.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                });
        }

        function submitForm(originalForm) {
            $(button).prop('disabled', true);
            $('#spinner-border').show();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                    $(button).prop('disabled', false);
                    $('#spinner-border').hide();
                    table.ajax.reload();
                })
                .fail(errors => {
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide()
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
        }

        function deleteData(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menghapus ' + name + ' ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Iya !',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: url,
                        dataType: "json",
                        success: function(response) {
                            if (response.status = 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                            table.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            // Menampilkan pesan error
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps! Gagal',
                                text: xhr.responseJSON.message,
                                showConfirmButton: true,
                            });

                            // Refresh tabel atau lakukan operasi lain yang diperlukan
                            table.ajax.reload();
                        }
                    });
                }
            });
        }
    </script>

    <script>
        //Initialize Select2 Elements
        $('#provider').select2({
            placeholder: 'Pilih provider',
            theme: 'bootstrap4',
            closeOnSelect: true,
            allowClear: true,
            ajax: {
                url: '{{ route('provider.search') }}',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.nama_provider
                            }
                        })
                    }
                }
            }
        })
    </script>
@endpush
