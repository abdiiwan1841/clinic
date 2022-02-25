<div class="col-md-12 mb-3">
    <a href="<?= base_url() ?>supplier/add" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                <table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th>Nama Supplier</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<!-- <th>Email</th> -->
							<th>Jenis Supp</th>
							<th>Tipe Supp</th>
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

<script type="text/javascript">
    var table;
    var base_url = '<?= base_url() ?>';
    var act = '';
    var Code_Cust = '';
    $(document).ready(function() {
        $("tbody").on('click','#edit',function(){
            Code_Cust = $(this).data('id');
            window.location.href = "<?= base_url() ?>supplier/edit/"+Code_Cust;
        })
        $("tbody").on('click','#hapus',function(){
            let Code_Cust = $(this).data('id');
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
                        url: base_url+'supplier/delete_rm/'+Code_Cust,
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
            $("#formsupplier")[0].reset();
            $('#addButton').text('Add supplier')
            $('#mymodalLabel').text('Add New supplier')
            let c_code = $('#c_code').val()
            $('#Code_Cust').attr('value',c_code)
            $("#mymodal").modal("show");
        })
        $("#addButton").click(function(){
            if (act == 'add') {
                $.ajax({
                    url: base_url+'supplier/save_rm',
                    method: "POST",
                    data : $("#formsupplier").serialize(),
                    success: function (res) {
                        if (res != 'true') {
                            swal("Gagal!", "supplier Code telah dipakai!", "error");
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
                    url: base_url+'supplier/edit_rm/'+Code_Cust,
                    method: "POST",
                    data : $("#formsupplier").serialize(),
                    success: function (res) {
                        swal({
                            title: "Data Tersimpan",
                            text: "Data supplier-10 telah teredit!",
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
                "url": "<?php echo site_url('supplier/get_data_supplier')?>",
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
