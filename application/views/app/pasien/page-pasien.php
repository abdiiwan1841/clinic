<div class="col-md-12 mb-3">
	<!-- <button data-toggle="modal" id="btn-show-table" class="btn btn-sm btn-success btn-sm"><i class="fa fa-list"></i>
		List Pasien</button> -->
	<a class="btn btn-sm btn-primary btn-sm" href="<?= base_url() ?>pasien/add"><i class="fa fa-plus"></i> Tambah Data</a>
</div>

<div class="col-md-12" id="show-table">
	<div class="box">
		<div class="box-body mt-3">
			<div class="table-responsive" id="getData">
				<table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th>MR CODE</th>
							<th>IC</th>
							<th>Nama</th>
							<th>Tanggal Lahir</th>
							<th>Jenis Kelamin</th>
							<th width="50"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modalview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Informasi Pasien</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">MR Code</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="MR_Code"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">No KTP</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_IC"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Nama Pasien</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="nama_pasien"></span>
                    </div>
                    <!-- <div class="col-md-6 mb-3">
                        <p class="mb-0">Patient_LName</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_LName"></span>
                    </div> -->
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Tanggal Lahir</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_DOB"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Agama</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Religion"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Jenis Kelamin</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Sex"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Status</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Status"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Alamat</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Address"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Negara</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Country"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Provinsi</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Prov"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Kota</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_City"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Kecamatan</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_kec"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Telepon</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Phone"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">No Handphone</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Mobile"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Pendidikan Terakhir</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Education"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Pekerjaan</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Job"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Nama Perusahaan</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Company"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">No BPJS</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_BPJSNo"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">Diagnosa Khusus</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Special"></span>
                    </div>
                    <!-- <div class="col-md-6 mb-3">
                        <p class="mb-0">Patient_Complete</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Complete"></span>
                    </div> -->
                    <div class="col-md-6 mb-3">
                        <p class="mb-0">E-mail</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_Email"></span>
                    </div>
                    <div class="col-md-6 mb-12">
                        <p class="mb-0">Keterangan</p>
                        <span style="word-wrap: break-word;" class="font-weight-normal" id="Patient_desc"></span>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
	base_url = "<?= base_url() ?>";
	$(document).ready(function () {
		$("#btn-show-add").click(function(){
			
		})
		negara = $('#Patient_Country').val()
		if (negara != 'Indonesia') {
			$(".hd").css('display','none')
		}else{
			$(".hd").css('display','block')
		}
		$("#Patient_Country").change(function(){
			negara = $(this).val()
			if (negara != 'Indonesia') {
				$(".hd").css('display','none')
			}else{
				$(".hd").css('display','block')
			}
		})

		$('.select2').select2();
		$('.kec').select2({
			minimumInputLength: 3
		});
		$('#btn-show-add').click(function () {
			$("#show-add").show();
			$("#show-table").hide();
		})
		$('#btn-show-table').click(function () {
			$("#show-add").hide();
			$("#show-table").show();
		})

		$('tbody').on("click","#update",function(){
			alert($(this).data('id'));
		})

		$("#addButton").click(function () {
			if ($("#Patient_FName").val() == '' || $("#Patient_DOB").val() == '' || $("#Patient_Address").val() == '' || $("#Patient_Phone").val() == ''  || $("#Patient_Mobile").val() == '') {
				swal("Gagal!", "Data tidak boleh kosong!", "error");
			}else{
				Swal.fire({
					title: "Are you sure?",
					html: 'Data pasien akan ditambahkan</strong>',
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Confirm!"
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url: base_url + "pasien/save/",
							method: "POST",
							data: $("form").serialize(),
							success: function (res) {
								$("form")[0].reset();
								swal("Berhasil!", "Data pasien tersimpan!", "success");
								location.reload();
							}
						});
					}
				})
			}
		})
		
		$('tbody').on("click","#btn-lihat",function(){
			var mr_code = $(this).data('id')
			tampil(mr_code)
		})

		BindItemTable();
	})

	function tampil(mr_code){
		$.ajax({
			url:  base_url+'pasien/lihat/'+mr_code,
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				$("#MR_Code").text(data.MR_Code);
				$("#Patient_IC").text(data.Patient_IC);
				$("#nama_pasien").text(data.Patient_FName + ' ' +data.Patient_LName);
				$("#Patient_DOB").text(data.Patient_DOB);
				$("#Patient_Religion").text(data.Patient_Religion);
				$("#Patient_Sex").text(data.Patient_Sex);
				$("#Patient_Status").text(data.Patient_Status);
				$("#Patient_Address").text(data.Patient_Address);
				$("#Patient_Country").text(data.Patient_Country);
				$("#Patient_Prov").text(data.Patient_Prov);
				$("#Patient_City").text(data.Patient_City);
				$("#Patient_kec").text(data.Patient_kec);
				$("#Patient_Phone").text(data.Patient_Phone);
				$("#Patient_Mobile").text(data.Patient_Mobile);
				$("#Patient_Education").text(data.Patient_Education);
				$("#Patient_Job").text(data.Patient_Job);
				$("#Patient_Company").text(data.Patient_Company);
				$("#Patient_BPJSNo").text(data.Patient_BPJSNo);
				if (data.Patient_Special == 1) {
					$("#Patient_Special").text(data.Patient_Type);
				}else{
					$("#Patient_Special").text('Tidak Ada');
				}
				$("#Patient_Email").text(data.Patient_Email);
				$("#Patient_desc").text(data.Patient_desc);
				$('#modalview').modal("show")
			},
			err(e) {
				console.log(e)
			}
		})
	}


	function BindItemTable() {
		var mytable = $('#example1').DataTable();
        dataSet = new Array();
		$.ajax({
			type: "POST",
			url: base_url + "pasien/data_pasien/",
			dataType: "json",
			success: function (res) {
				for (let i = 0; i < res.length; i++) {
					dataSet.push([i + 1, res[i].MR_Code, res[i].Patient_IC, res[i].Patient_FName+' '+res[i].Patient_LName, res[i]
						.Patient_DOB, res[i].Patient_Sex, res[i].MR_Code
                    ]);
				}
				table_fetch();
			},
			failure: function () {
				$("#example1").append(" Error when fetching data please contact administrator");
			}
		});

	}

	function table_fetch() {
		$('#example1').DataTable({
			destroy: true,
			data: dataSet,
			columns: [{
					title: "No."
				},
				{
					title: "MR Code"
				},
				{
					title: "IC"
				},
				{
					title: "Nama"
				},
				{
					title: "Tanggal Lahir"
				},
				{
					title: "Jenis Kelamin"
				},
				// {
				// 	"render": function (data, type, full, meta) {
				// 		return `
				// 		<a class="btn-sm btn btn-warning text-white" href="`+base_url+`pasien/edit/?MR_Code=` + data + `"><i
                //     class="fa fa-edit"></i></a>`;
				// 	}
				// },
				{
					"render": function (data, type, full, meta) {
						return `
						<a class="btn-sm btn btn-info text-white" id="btn-lihat" data-id="`+data+`"><i
                    class="fa fa-eye"></i></a>
						<a class="btn-sm btn btn-warning text-white" href="`+base_url+`pasien/edit/?MR_Code=` + data + `"><i
                    class="fa fa-edit"></i></a>`;
					}
				}
			]
		});
	}

	function PopulateItemsTable() {
		$.ajax({
			type: "POST",
			url: base_url + "pasien/data_pasien/",
			dataType: "json",
			success: function (response) {
				// for (let i = 0; i < response.length; i++) {
				//     response[i].push(item.MR_Code);
				// }
				var jsonObject = JSON.parse(response);
				var result = jsonObject.map(function (item) {
					var result = [];
					result.push(item.MR_Code);
					result.push(item.Patient_IC);
					result.push(item.Patient_FName);
					result.push(item.Patient_DOB);
					result.push(item.Patient_Sex);
					result.push("");
					return result;
				});
				console.log(result)

				myTable.rows.add(result);
				myTable.draw();
			},
			failure: function () {
				$("#example1").append(" Error when fetching data please contact administrator");
			}
		});
	}
</script>