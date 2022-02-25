<div class="col-md-12">
	<div class="box">
		<div class="box-body mt-3">
			<div class="table-responsive" id="getData">
				<table class="table" style="width: 100% !important;" id="example1">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th>No Antrian</th>
							<th>No Visit</th>
							<th>Tgl Daftar</th>
							<th>Nama Pasien</th>
							<th>Dokter</th>
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

<form action="">
	<input type="hidden" name="novisit" value="" id="novisit">
	<input type="hidden" name="status_antrian" id="status">
</form>


<script type="text/javascript">
	$(document).ready(function () {
        tampil();
        $("tbody").on("click", '.call', function () {
			var novisit = $("#novisit").val($(this).attr('novisit'));
			var novisit2 = $(this).attr('novisit');
            $("#status").val("Konsultasi");
			Swal.fire({
				title: "Are you sure?",
				html: 'Antrian Pasien akan di panggilkan',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '<?php echo site_url('antrian/call/')?>' +novisit2,
						method: "POST",
						data: $("form").serialize(),
						success: function (res) {
							console.log(res);
							swal("Berhasil!", "Pasien berhasil di panggil!","success");
                            tampil();
							// window.location.reload();
							// setTimeout(function(){window.location.href="<?= base_url() ?>supplier"} , 2000); 
							// window.location.href = "<?= base_url() ?>supplier";
						}
					});
				}
			})
		})
	});

	function tampil() {
        $('#example1').DataTable().clear();
        $('#example1').DataTable().destroy();
		$('#example1').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo site_url('antrian/get_data_registrasi')?>",
				"type": "POST"
			},


			"columnDefs": [{
				"targets": [0],
				"orderable": false,
			}, ],

		});
	}

</script>

<!-- <script>
	$(document).ready(function () {
        tampil();
        $("tbody").on("click", '.cancel', function () {
			var novisit = $("#novisit").val($(this).attr('novisit'));
			var novisit2 = $(this).attr('novisit');
			$("#status").val("Batal");
			Swal.fire({
				title: "Are you sure?",
				html: 'Antrian Pasien akan di batalkan',
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: '<?php echo site_url('antrian/call/')?>' +novisit2,
						method: "POST",
						data: $("form").serialize(),
						success: function (res) {
							console.log(res);
							swal("Berhasil!", "Pasien berhasil di batalkan!","success");
                            tampil();
							// window.location.reload();
							// setTimeout(function(){window.location.href="<?= base_url() ?>supplier"} , 2000); 
							// window.location.href = "<?= base_url() ?>supplier";
						}
					});
				}
			})
		})
	});
</script> -->
