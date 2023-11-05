@push('scripts')
    <script>
        let table;
        let modal = '#modal-form';
        let button = '#submitBtn';

        let opsiPilihan = document.getElementById("opsiPilihan");

        let pulsa = document.getElementById("Inputpulsa");
        let pulsaInput = document.getElementById("pulsaInput");
        let hargaPulsa = document.getElementById("hargaPulsa");
        let produk = document.getElementById("produk");
        let jumlahPembelian = document.getElementById("jumlahPembelian");
        let harga = document.getElementById("harga");


        $(function() {
            $('#spinner-border').hide();
        });

        table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            language: {
                "processing": "Mohon bersabar..."
            },
            ajax: {
                url: '{{ route('pembelian.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'kode_pembelian',
                },
                {
                    data: 'produk',
                },
                {
                    data: 'jumlah_pembelian',
                },
                {
                    data: 'pulsa',
                },
                {
                    data: 'harga',
                },
                {
                    data: 'aksi',
                    sortable: false,
                    searchable: false
                },
            ]
        });

        function addData(url, title = 'Tambah Data Pelanggan') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');
            $('#spinner-border').hide();
            // $("#status_pemilihan").hide();
            $(button).show();
            $(button).prop('disabled', false);
            resetForm(`${modal} form`);
            hiddenFields();
        }

        function editData(url, title = 'Edit Data Pelanggan') {
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
        function toggleInput() {
            if (opsiPilihan.value === "pulsa") {
                pulsa.style.display = "block";
                pulsaInput.style.display = "none";
                hargaPulsa.style.display = "none";
                produk.style.display = "none";
                jumlahPembelian.style.display = "none";
                harga.style.display = "none";
                resetFields();
            } else if (opsiPilihan.value === "vocer") {
                pulsa.style.display = "none";
                pulsaInput.style.display = "none";
                hargaPulsa.style.display = "none";
                produk.style.display = "block";
                jumlahPembelian.style.display = "block";
                harga.style.display = "none";
                resetFields();
            } else if (opsiPilihan.value === "lainya") {
                pulsa.style.display = "none";
                pulsaInput.style.display = "none";
                hargaPulsa.style.display = "none";
                produk.style.display = "block";
                jumlahPembelian.style.display = "block";
                harga.style.display = "none";
                resetFields();
            } else {
                hiddenFields();
                resetFields();
            }
        }

        function resetFields() {
            $('[name=pulsa]').val('');
            $('[name=saldo_pulsa]').val('');
            $('[name=harga_pulsa]').val('');
            $('[name=harga]').val('');
            $('[name=jumlah_pembelian]').val('');
            $('.select2').val(null).trigger('change');
        }

        function hiddenFields() {
            pulsa.style.display = "none";
            pulsaInput.style.display = "none";
            hargaPulsa.style.display = "none";
            produk.style.display = "none";
            jumlahPembelian.style.display = "none";
            harga.style.display = "none";
        }
    </script>

    <script>
        //Initialize Select2 Elements
        $('#vocer').select2({
            placeholder: 'Pilih vocer',
            theme: 'bootstrap4',
            closeOnSelect: true,
            allowClear: true,
            ajax: {
                url: '{{ route('produk.search') }}',
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.nama_produk
                            }
                        })
                    }
                }
            }
        });
    </script>


    <script>
        $('#pulsa').select2({
            placeholder: 'Pilih jenis pulsa',
            theme: 'bootstrap4',
            closeOnSelect: true,
            allowClear: true,
            ajax: {
                url: '{{ route('pulsa.search') }}',
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text:item.provider.nama_provider + ' Nominal ' + format_uang(item.nominal),
                            }
                        })
                    }
                }
            }
        })
    </script>
@endpush
