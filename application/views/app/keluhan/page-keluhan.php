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
                <h5 class="modal-title" id="mymodalLabel">Add New Keluhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formkeluhan" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- <div class="form-group c_keluhan" style="display:none;">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <input type="hidden" name="old_kode" id="old_kode" class="form-control">
                        <label>Kode Keluhan</label>
                    </div> -->
                        <input type="hidden" name="kode_keluhan" id="kode_keluhan" class="form-control">
                    <div class="form-group">
                        <label>Nama Keluhan</label>
                        <input type="text" name="nama_keluhan" id="nama_keluhan" class="form-control">
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
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="addButton">Add Keluhan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        getkeluhant();

        function getkeluhant() {
            $.ajax({
                url: "<?php echo base_url(); ?>keluhan/keluhan_fetch",
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
        // Add keluhan
        $(document).on('click', ".addSubmit", function(e) {
            $('#status').show();
            e.preventDefault()
            var form_data = new FormData($('#formkeluhan')[0])
            $.ajax({
                url: '<?= base_url() ?>keluhan/keluhan_add',
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
                        $('#formkeluhan').trigger("reset");
                        getkeluhant();
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
            const kode_keluhan = $(this).data('kode_keluhan');

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
                        url: '<?= base_url() ?>keluhan/keluhan_delete',
                        data: {
                            kode_keluhan: kode_keluhan
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            swal("Berhasil!", "Data berhasil dihapuskan!", "success");
                            getkeluhant();
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
            $("#kode_keluhan").attr("readonly", false);
            $("#kode_keluhan").hide();
            $('#formkeluhan').trigger("reset");
            $('#mymodal #mymodalLabel').html('Add New keluhan')
            $('#mymodal #addButton').html('Add New keluhan')
            $('#addButton').addClass('addSubmit')
            $('#addButton').removeClass('editSubmit')
            $('#mymodal').modal('show');
        })
        $(document).on('click', ".editButton", function() {
            $('.c_keluhan').css("display",'block');
            $('#kode_keluhan').attr('readonly', true);
            const kode_keluhan = $(this).data('kode_keluhan');
            $.ajax({
                url: '<?= base_url() ?>keluhan/keluhan_selected',
                data: {
                    kode_keluhan: kode_keluhan
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#old_kode').val(data['kode_keluhan'])
                    $('#kode_keluhan').val(data['kode_keluhan'])
                    $('#status').val(data['status'])
                    $('#nama_keluhan').val(data['nama_keluhan'])
                    $('#mymodal #mymodalLabel').html('Edit keluhan')
                    $('#mymodal #addButton').html('Edit keluhan')
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
            var form_data = new FormData($('#formkeluhan')[0])
            $.ajax({
                url: '<?= base_url() ?>keluhan/keluhan_update',
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
                        $('#formkeluhan').trigger("reset");
                        getkeluhant();
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
