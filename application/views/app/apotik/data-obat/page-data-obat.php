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
                <h5 class="modal-title" id="mymodalLabel">Add New Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formobat" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="kode_obat" id="kode_obat" class="form-control">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="form-control">
                    </div>
                    <div class="form-group">
						<label>Kategori Obat</label>
						<select class="form-control select2" name="kategori_obat" id="kategori_obat">
                            <?php  
                                $query = $this->db->query("select * from kategori_obat");
                                $kategori_obat = $query->result_array();
                                foreach ($kategori_obat as $key => $row){
									echo "<option value='".$row['kode_kategori_obat']."'>".$row['nama_kategori_obat']."</option>";
                                }
                            ?>
						</select>
					</div>
                    <!-- <div class="form-group">
                        <label>Satuan Obat</label>
                        <input type="text" name="satuan" id="satuan" class="form-control">
                    </div> -->
                    <div class="form-group">
						<label>Satuan Obat</label>
						<select class="form-control select2" name="satuan" id="satuan">
                            <?php  
                                $query = $this->db->query("select * from satuan_obat");
                                $satuan_obat = $query->result_array();
                                foreach ($satuan_obat as $key => $row){
									echo "<option value='".$row['kode_satuan_obat']."'>".$row['nama_satuan_obat']."</option>";
                                }
                            ?>
						</select>
					</div>
                    <div class="form-group">
                        <label>Harga Obat</label>
                        <input type="text" name="harga" id="harga" class="form-control">
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
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="addButton">Add obat</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // $('select').select2();
        getobatt();

        function getobatt() {
            $.ajax({
                url: "<?php echo base_url(); ?>data_obat/obat_fetch",
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
        // Add obat
        $(document).on('click', ".addSubmit", function(e) {
            $('#status').show();
            e.preventDefault()
            var form_data = new FormData($('#formobat')[0])
            $.ajax({
                url: '<?= base_url() ?>data_obat/obat_add',
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
                        $('#formobat').trigger("reset");
                        getobatt();
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
            const kode_obat = $(this).data('kode_obat');

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
                        url: '<?= base_url() ?>data_obat/obat_delete',
                        data: {
                            kode_obat: kode_obat
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            swal("Berhasil!", "Data berhasil dihapuskan!", "success");
                            getobatt();
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
            $("#kode_obat").attr("readonly", false);
            $("#kode_obat").hide();
            $('#formobat').trigger("reset");
            $('#mymodal #mymodalLabel').html('Add New Obat')
            $('#mymodal #addButton').html('Add New Obat')
            $('#addButton').addClass('addSubmit')
            $('#addButton').removeClass('editSubmit')
            $('#mymodal').modal('show');
        })
        $(document).on('click', ".editButton", function() {
            $('.c_obat').css("display",'block');
            $('#kode_obat').attr('readonly', true);
            const kode_obat = $(this).data('kode_obat');
            $.ajax({
                url: '<?= base_url() ?>data_obat/obat_selected',
                data: {
                    kode_obat: kode_obat
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#old_kode').val(data['kode_obat'])
                    $('#kode_obat').val(data['kode_obat'])
                    $('#nama_obat').val(data['nama_obat'])
                    $('#kategori_obat').val(data['kategori_obat'])
                    $('#satuan').val(data['satuan'])
                    $('#harga').val(data['harga'])
                    $('#status').val(data['status'])
                    $('#nama_obat').val(data['nama_obat'])
                    $('#mymodal #mymodalLabel').html('Edit obat')
                    $('#mymodal #addButton').html('Edit obat')
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
            var form_data = new FormData($('#formobat')[0])
            $.ajax({
                url: '<?= base_url() ?>data_obat/obat_update',
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
                        $('#formobat').trigger("reset");
                        getobatt();
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
