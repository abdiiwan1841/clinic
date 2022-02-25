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
                <h5 class="modal-title" id="mymodalLabel">Add New Satuan Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formsatuan_obat" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- <div class="form-group c_satuan_obat" style="display:none;">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <input type="hidden" name="old_kode" id="old_kode" class="form-control">
                        <label>Kode satuan_obat</label>
                    </div> -->
                        <input type="hidden" name="kode_satuan_obat" id="kode_satuan_obat" class="form-control">
                    <div class="form-group">
                        <label>Nama Satuan Obat</label>
                        <input type="text" name="nama_satuan_obat" id="nama_satuan_obat" class="form-control">
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
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="addButton">Add satuan_obat</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        getsatuan_obatt();

        function getsatuan_obatt() {
            $.ajax({
                url: "<?php echo base_url(); ?>satuan_obat/satuan_obat_fetch",
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
        // Add satuan_obat
        $(document).on('click', ".addSubmit", function(e) {
            $('#status').show();
            e.preventDefault()
            var form_data = new FormData($('#formsatuan_obat')[0])
            $.ajax({
                url: '<?= base_url() ?>satuan_obat/satuan_obat_add',
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
                        $('#formsatuan_obat').trigger("reset");
                        getsatuan_obatt();
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
            const kode_satuan_obat = $(this).data('kode_satuan_obat');

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
                        url: '<?= base_url() ?>satuan_obat/satuan_obat_delete',
                        data: {
                            kode_satuan_obat: kode_satuan_obat
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            swal("Berhasil!", "Data berhasil dihapuskan!", "success");
                            getsatuan_obatt();
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
            $("#kode_satuan_obat").attr("readonly", false);
            $("#kode_satuan_obat").hide();
            $('#formsatuan_obat').trigger("reset");
            $('#mymodal #mymodalLabel').html('Add New Satuan Obat')
            $('#mymodal #addButton').html('Add New Satuan Obat')
            $('#addButton').addClass('addSubmit')
            $('#addButton').removeClass('editSubmit')
            $('#mymodal').modal('show');
        })
        $(document).on('click', ".editButton", function() {
            $('.c_satuan_obat').css("display",'block');
            $('#kode_satuan_obat').attr('readonly', true);
            const kode_satuan_obat = $(this).data('kode_satuan_obat');
            $.ajax({
                url: '<?= base_url() ?>satuan_obat/satuan_obat_selected',
                data: {
                    kode_satuan_obat: kode_satuan_obat
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#old_kode').val(data['kode_satuan_obat'])
                    $('#kode_satuan_obat').val(data['kode_satuan_obat'])
                    $('#status').val(data['status'])
                    $('#nama_satuan_obat').val(data['nama_satuan_obat'])
                    $('#mymodal #mymodalLabel').html('Edit satuan_obat')
                    $('#mymodal #addButton').html('Edit satuan_obat')
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
            var form_data = new FormData($('#formsatuan_obat')[0])
            $.ajax({
                url: '<?= base_url() ?>satuan_obat/satuan_obat_update',
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
                        $('#formsatuan_obat').trigger("reset");
                        getsatuan_obatt();
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
