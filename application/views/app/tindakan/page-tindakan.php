<div class="col-md-12 mb-3">
    <a href="#" id="buttonAddNew" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                <table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th width='150'>Kode Barang/Tindakan</th>
							<th>Nama Barang/Tindakan</th>
							<th>Tipe</th>
							<th>Satuan</th>
							<th>Harga</th>
							<th>Kode Dokter</th>
							<th>Status</th>
							<th width="10"></th>
						</tr>
					</thead>
                    <tbody>
                    </tbody>
				</table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mymodalLabel">Add New tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formtindakan">
                <input type="hidden" id="c_item" value="<?= $code_item ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Kode Item</label>
                            <input type="text" name="item_code" id="item_code" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Item</label>
                            <input type="text" name="item_name" id="item_name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Tipe Item</label>
                            <select class="form-control select2" name="item_type" id="item_type"
                                style="width: 100%;">
                                <option value="" selected>--Pilih--</option>
                                <option value="Honor">Honor</option>
                                <option value="Service">Service</option>
                                <option value="Inven">Inven</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Satuan</label>
                            <input type="text" name="item_uom" id="item_uom" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Harga</label>
                            <input type="text" name="item_price" id="item_price" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select class="form-control select2" name="status" id="status"
                                style="width: 100%;">
                                <option value="" selected>--Pilih--</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non Aktif">Non Aktif</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label>Dokter</label>
                            <select class="form-control select2" name="doctor_code" id="doctor_code"
                                style="width: 100%;">
                                <?php  
                                    $q = $this->db->query('SELECT * FROM dokter');
                                    $dokter = $q->result_array();
                                    echo "<option value='' selected>--Pilih--</option>";
                                    foreach ($dokter as $key => $row){
                                        echo "<option value='".$row['kode_dokter']."'>".$row['nama_dokter']."</option>";
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer col-md-12 text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="addButton">Add tindakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    var base_url = '<?= base_url() ?>';
    var act = '';
    var item_code = '';
    $(document).ready(function() {
        $("tbody").on('click','#edit',function(){
            item_code = $(this).data('id');
            act = 'edit';
            $('#item_code').attr('readonly',true)
            $.ajax({
                type: "POST",
                url: base_url + "tindakan/data_edit/"+item_code,
                dataType: "json",
                success: function (res) {
                    $('#addButton').text('Edit tindakan')
                    $('#item_code').val(res.item_code)
                    $('#item_name').val(res.item_name)
                    $('#item_type').val(res.item_type)
                    $('#item_type [value='+res.item_type+']').attr('selected','selected');
                    $('#item_uom').val(res.item_uom)
                    $('#item_price').val(res.item_price)
                    $('#doctor_code').val(res.doctor_code)
                    $('#status').val(res.status)
                    $('#mymodalLabel').text('Edit data tindakan')
                    $("#mymodal").modal("show");
                },
                failure: function () {
                    $("#example1").append(" Error when fetching data please contact administrator");
                }
            });
        })
        $("tbody").on('click','#hapus',function(){
            let item_code = $(this).data('id');
            Swal.fire({
                title: "Apakah kamu yakin?",
                html: 'Data Akan dihapus',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: base_url+'tindakan/delete_rm/'+item_code,
                        success: function () {
                            swal("Berhasil!", "Data terhapus!", "success");
                            location.reload()
                        }
                    });
                }
            })
        })
        $("#buttonAddNew").click(function(){
            act = 'add';
            $("#formtindakan")[0].reset();
            $('#addButton').text('Add tindakan')
            $('#mymodalLabel').text('Add New tindakan')
            let c_item = $('#c_item').val()
            $('#item_code').attr('value',c_item)
            $("#mymodal").modal("show");
        })
        $("#addButton").click(function(){
            if (act == 'add') {
                $.ajax({
                    url: base_url+'tindakan/save_rm',
                    method: "POST",
                    data : $("#formtindakan").serialize(),
                    success: function (res) {
                        if (res != 'true') {
                            swal("Gagal!", "tindakan Code telah dipakai!", "error");
                        }else{
                            swal({
                                title: "Data Tersimpan",
                                text: "Data pasien telah tersimpan",
                                icon: "success",
                                button: "OK",
                            }).then(function(){
                                window.location.reload();
                            });
                        }
                    }
                });   
            }else{
                $.ajax({
                    url: base_url+'tindakan/edit_rm/'+item_code,
                    method: "POST",
                    data : $("#formtindakan").serialize(),
                    success: function (res) {
                        swal({
                            title: "Data Tersimpan",
                            text: "Data tindakan-10 telah teredit!",
                            icon: "success",
                            button: "OK",
                        }).then(function(){
                            window.location.reload();
                        });
                    }
                });
            }
        })

        //datatables
        table = $('#example1').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo site_url('Tindakan/get_data_tindakan')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],
 
        });
 
    });
 
</script>
