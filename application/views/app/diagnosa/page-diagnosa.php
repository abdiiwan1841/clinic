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
							<th width='150'>Kode ICD-10</th>
							<th>Diagnosa</th>
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
                <h5 class="modal-title" id="mymodalLabel">Add New ICD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="formICD">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode ICD</label>
                        <input type="text" name="ICD_Code" id="ICD_Code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <input type="text" name="ICD_Desc" id="ICD_Desc" class="form-control">
                    </div>
                </div>
                <div class="modal-footer col-md-12 text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="addButton">Add ICD</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    var base_url = '<?= base_url() ?>';
    var act = '';
    var icd_code = '';
    $(document).ready(function() {
        $("tbody").on('click','#edit',function(){
            icd_code = $(this).data('id');
            act = 'edit';
            $('#ICD_Code').attr('readonly',true)
            $.ajax({
                type: "POST",
                url: base_url + "diagnosa/data_edit/"+icd_code,
                dataType: "json",
                success: function (res) {
                    $('#addButton').text('Edit ICD')
                    $('#ICD_Code').val(res.ICD_Code)
                    $('#ICD_Desc').val(res.ICD_Desc)
                    $('#mymodalLabel').text('Edit data ICD')
                    $("#mymodal").modal("show");
                },
                failure: function () {
                    $("#example1").append(" Error when fetching data please contact administrator");
                }
            });
        })
        $("tbody").on('click','#hapus',function(){
            let icd_code = $(this).data('id');
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
                        url: base_url+'Diagnosa/delete_rm/'+icd_code,
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
            $("#formICD")[0].reset();
            $('#addButton').text('Add ICD')
            $('#mymodalLabel').text('Add New ICD')
            $('#ICD_Code').attr('readonly',false)
            $("#mymodal").modal("show");
        })
        $("#addButton").click(function(){
            if (act == 'add') {
                $.ajax({
                    url: base_url+'Diagnosa/save_rm',
                    method: "POST",
                    data : $("#formICD").serialize(),
                    success: function (res) {
                        if (res != 'true') {
                            swal("Gagal!", "ICD Code telah dipakai!", "error");
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
                    url: base_url+'Diagnosa/edit_rm/'+icd_code,
                    method: "POST",
                    data : $("#formICD").serialize(),
                    success: function (res) {
                        swal({
                            title: "Data Tersimpan",
                            text: "Data ICD-10 telah teredit!",
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
                "url": "<?php echo site_url('Diagnosa/get_data_icd')?>",
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
