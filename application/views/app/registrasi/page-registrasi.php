<div class="col-md-12 mb-3">
    <a href="<?= base_url() ?>registrasi/add" class="btn btn-sm btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
<div class="col-md-12">
    <div class="box">
        <div class="box-body mt-3">
            <div class="table-responsive" id="getData">
                <table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th>No Visit</th>
							<th>Tgl Daftar</th>
							<th>Nama Pasien</th>
							<th>Dokter</th>
							<th>Keluhan</th>
							<th width="10">Status</th>
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
    var no_visit = '';
    $(document).ready(function() {
        $("tbody").on('click','#edit',function(){
            no_visit = $(this).data('id');
            window.location.href = "<?= base_url() ?>registrasi/edit/"+no_visit;
        })
        $("tbody").on('click','#hapus',function(){
            let no_visit = $(this).data('id');
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
                        url: base_url+'registrasi/delete_rm/'+no_visit,
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
            $("#formregistrasi")[0].reset();
            $('#addButton').text('Add registrasi')
            $('#mymodalLabel').text('Add New registrasi')
            let c_code = $('#c_code').val()
            $('#no_visit').attr('value',c_code)
            $("#mymodal").modal("show");
        })
        $("#addButton").click(function(){
            if (act == 'add') {
                $.ajax({
                    url: base_url+'registrasi/save_rm',
                    method: "POST",
                    data : $("#formregistrasi").serialize(),
                    success: function (res) {
                        if (res != 'true') {
                            swal("Gagal!", "registrasi Code telah dipakai!", "error");
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
                    url: base_url+'registrasi/edit_rm/'+no_visit,
                    method: "POST",
                    data : $("#formregistrasi").serialize(),
                    success: function (res) {
                        swal({
                            title: "Data Tersimpan",
                            text: "Data registrasi-10 telah teredit!",
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
                "url": "<?php echo site_url('registrasi/get_data_registrasi')?>",
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