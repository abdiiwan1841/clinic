<div class="col-md-12 mb-3">
    <a href="<?= base_url() ?>rujukan/add" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                <table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th>Nama Rujukan</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<!-- <th>Email</th> -->
							<th>No Hp</th>
							<th>Jenis Rujukan</th>
							<th width="10">Status</th>
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
    var kode_rujukan = '';
    $(document).ready(function() {
        $("tbody").on('click','#edit',function(){
            kode_rujukan = $(this).data('id');
            window.location.href = "<?= base_url() ?>rujukan/edit/"+kode_rujukan;
        })
        $("tbody").on('click','#hapus',function(){
            let kode_rujukan = $(this).data('id');
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
                        url: base_url+'rujukan/delete_rm/'+kode_rujukan,
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
            $("#formrujukan")[0].reset();
            $('#addButton').text('Add rujukan')
            $('#mymodalLabel').text('Add New rujukan')
            let c_code = $('#c_code').val()
            $('#kode_rujukan').attr('value',c_code)
            $("#mymodal").modal("show");
        })
        $("#addButton").click(function(){
            if (act == 'add') {
                $.ajax({
                    url: base_url+'rujukan/save_rm',
                    method: "POST",
                    data : $("#formrujukan").serialize(),
                    success: function (res) {
                        if (res != 'true') {
                            swal("Gagal!", "rujukan Code telah dipakai!", "error");
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
                    url: base_url+'rujukan/edit_rm/'+kode_rujukan,
                    method: "POST",
                    data : $("#formrujukan").serialize(),
                    success: function (res) {
                        swal({
                            title: "Data Tersimpan",
                            text: "Data rujukan-10 telah teredit!",
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
                "url": "<?php echo site_url('rujukan/get_data_rujukan')?>",
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
