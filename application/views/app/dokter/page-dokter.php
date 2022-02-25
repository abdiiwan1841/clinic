<div class="col-md-12 mb-3">
    <a href="<?=base_url()?>dokter/add" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                <table class="table table-sm table-striped" style="width: 100% !important;" id="table">
                    <thead>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Nama Spesialis</th>
                            <th >Alamat</th>
                            <th>No Telp - Handphone</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>No Telp1</th>
                            <th >Alamat</th>
                            <th>No Telp - Handphone</th>
                            <th>Status</th>
                                                  
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        getDokter();

        function getDokter() {
            table = $('#table').DataTable({ 
                "processing": true, 
                "serverSide": true, 
                "order": [], 
                "ajax": {
                    "url": "<?php echo site_url('dokter/get_dokter')?>",
                    "type": "POST",
                    "error":function (xhr, error, code)
                    {
                        console.log(xhr);
                        console.log(code);
                    }
                },
                "columnDefs": [
                { 
                    "targets": [ 0 ], 
                    "orderable": false, 
                },
                ],
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImageCategory').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        // Add Dokter
        $(document).on('click', ".addSubmit", function(e) {
            e.preventDefault()
            var form_data = new FormData($('#formDokter')[0])
            $.ajax({
                url: '<?= base_url() ?>spesialis/spesialis_add',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    message = response.split("|")
                    if (message[0] == 'Error') {
                        swal("Gagal!", "Data gagal ditambahkan!", "error");
                    } else {
                        swal("Berhasil!", "Data berhasil ditambahkan!", "success");
                        $('#formDokter').trigger("reset");
                        getDokter();
                    }
                },
                error: function(err) {
                    console.log(err)
                    swal('Error ' + err.status, err.statusText);
                }
            });
        })

        // Set Active not Active Category Product
        $(document).on('click', ".deleteButton", function() {
            const id = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: 'Apakah kamu yakin menghapus data tersebut?.',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>spesialis/spesialis_delete',
                        data: {
                            id: id
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            swal("Berhasil!", "Data berhasil dihapuskan!", "success");
                            getDokter();
                        },
                        err(e) {
                            console.log(e)
                        }
                    })

                }
            })
        });

        // Get Edit Data
        $('#buttonAddNew').click(function() {
            $('#formDokter').trigger("reset");

            $('#mymodal #mymodalLabel').html('Add New Dokter')
            $('#mymodal #addButton').html('Add New Dokter')
            $('#addButton').addClass('addSubmit')
            $('#addButton').removeClass('editSubmit')
            $('#mymodal').modal('show');
        })
        $(document).on('click', ".editButton", function() {
            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url() ?>spesialis/spesialis_selected',
                data: {
                    id: id
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data['id'])
                    $('#nama_spesialis').val(data['nama_spesialis'])

                    $('#mymodal #mymodalLabel').html('Edit Dokter')
                    $('#mymodal #addButton').html('Edit Dokter')
                    $('#addButton').removeClass('addSubmit')
                    $('#addButton').addClass('editSubmit')
                    $('#mymodal').modal('show');
                },
                err(e) {
                    console.log(e)
                }
            })
        })
        // Edit Submit
        $(document).on('click', ".editSubmit", function(e) {
            e.preventDefault()
            var form_data = new FormData($('#formDokter')[0])
            $.ajax({
                url: '<?= base_url() ?>spesialis/spesialis_update',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    message = response.split("|")
                    if (message[0] == 'Error') {
                        swal("Gagal!", "Data gagal diperbarui!", "error");
                    } else {
                        swal("Berhasil!", "Data berhasil diperbarui!", "success");
                        $('#formDokter').trigger("reset");
                        getDokter();
                    }
                },
                error: function(err) {
                    console.log(err)
                    swal('Error ' + err.status, err.statusText);
                }
            });
        })
    })
</script>
