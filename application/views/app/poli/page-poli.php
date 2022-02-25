<div class="col-md-12 mb-3">
    <a href="#" data-toggle="modal" data-target="#mymodal" id="buttonAddNew" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mymodalLabel">Add New Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formpoli" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <input type="hidden" name="old_kode" id="old_kode" class="form-control">
                        <label>Kode poli</label>
                        <input type="text" name="kode_poli" id="kode_poli" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama poli</label>
                        <input type="text" name="nama_poli" id="nama_poli" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer col-md-12">
                    <button type="submit" class="btn btn-success" data-dismiss="modal" id="addButton">Add Poli</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        getpolit();

        function getpolit() {
            $.ajax({
                url: "<?php echo base_url(); ?>poli/poli_fetch",
                method: "POST",
                success: function(data) {
                    $('#getData').html(data);
                    $("#example1").DataTable();
                },
                error: function(err) {
                    console.log(err)
                    swal('Error ' + err.status, err.statusText);
                }
            })
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
        // Add poli
        $(document).on('click', ".addSubmit", function(e) {
            e.preventDefault()
            var form_data = new FormData($('#formpoli')[0])
            $.ajax({
                url: '<?= base_url() ?>poli/poli_add',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    message = response.split("|")
                    if (message[0] == 'Error') {
                        swalError("Gagal!", message[1], "error");
                    } else {
                        swalSuccess("Berhasil!", "Data berhasil ditambahkan!", "success");
                        $('#formpoli').trigger("reset");
                        getpolit();
                    }
                },
                error: function(err) {
                    console.log(err)
                    swalError('Error ' + err.status, err.statusText);
                }
            });
        })

        // Set Active not Active Category Product
        $(document).on('click', ".deleteButton", function() {
            const kode_poli = $(this).data('kode_poli');

            Swal.fire({
                title: "Are you sure?",
                text: 'Apakah kamu yakin menghapus data tersebut?.',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>poli/poli_delete',
                        data: {
                            kode_poli: kode_poli
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            swal("Berhasil!", "Data berhasil dihapuskan!", "success");
                            getpolit();
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
            $('#formpoli').trigger("reset");
            $("#kode_poli").attr("readonly", false);
            $('#mymodal #mymodalLabel').html('Add New Poli')
            $('#mymodal #addButton').html('Add New Poli')
            $('#addButton').addClass('addSubmit')
            $('#addButton').removeClass('editSubmit')
            $('#mymodal').modal('show');
        })
        $(document).on('click', ".editButton", function() {
            $("#kode_poli").attr("readonly", true);
            const kode_poli = $(this).data('kode_poli');
            $.ajax({
                url: '<?= base_url() ?>poli/poli_selected',
                data: {
                    kode_poli: kode_poli
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#old_kode').val(data['kode_poli'])
                    $('#kode_poli').val(data['kode_poli'])
                    $('#nama_poli').val(data['nama_poli'])
                    $('#mymodal #mymodalLabel').html('Edit Poli')
                    $('#mymodal #addButton').html('Edit Poli')
                    $('#status').val(data['status'])
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
            var form_data = new FormData($('#formpoli')[0])
            $.ajax({
                url: '<?= base_url() ?>poli/poli_update',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    message = response.split("|")
                    if (message[0] == 'Error') {
                        swalError("Gagal!", message[1], "error");
                    } else {
                        swalSuccess("Berhasil!", "Data berhasil diperbarui!", "success");
                        $('#formpoli').trigger("reset");
                        getpolit();
                    }
                },
                error: function(err) {
                    console.log(err)
                    swalError('Error ' + err.status, err.statusText);
                }
            });
        })
    })
</script>
