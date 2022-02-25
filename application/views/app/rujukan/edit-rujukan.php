<div class="col-12">
	<div class="box">
		<div class="box-header">
			<h4 class="box-title">Edit Rujukan</h4>
		</div>
		<div class="box-body">
			<form method="POST">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Kode Rujukan</label>
						<input type="text" name="kode_rujukan" id="kode_rujukan" value="<?= $get['kode_rujukan'] ?>" class="form-control" readonly>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Rujukan</label>
						<input type="text" name="nama_rujukan" id="nama_rujukan" class="form-control" value="<?= $get['nama_rujukan'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control" value="<?= $get['alamat'] ?>">
					</div>
					<div class="form-group col-md-4 hd">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="kota" id="kota" style="width: 100%;">
							<?php  
								foreach ($kota as $key => $row){
									if ($row == $get['kota']){
										echo "<option value='$row' selected>$row</option>";
									}else{
										echo "<option value='$row'>$row</option>";
									}
								} 
							?>
						</select>
					</div>
					<div class="form-group col-md-4 hd">
						<label>Provinsi</label>
						<select class="form-control select2" name="provinsi" id="provinsi" style="width: 100%;">
							<?php  
								foreach ($provinsi as $key => $row){
									if ($row == $get['provinsi']){
										echo "<option value='$row' selected>$row</option>";
									}else{
										echo "<option value='$row'>$row</option>";
									}
								} 
							?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Negara</label>
						<input type="text" class="form-control" name="negara" value="<?= $get['negara'] ?>" readonly>
						<!-- <select class="form-control select2" name="negara" id="negara" style="width: 100%;">
							<?php  
								foreach ($negara as $key => $row){
									if ($row['name'] == $get['negara']){
										echo "<option value='".$row['name']."' selected>".$row['name']."</option>";
									}else{
										echo "<option value='".$row['name']."'>".$row['name']."</option>";
									}
								} 
							?>
						</select> -->
					</div>
					<div class="form-group col-md-4">
						<label>Telepon</label>
						<input type="number" name="no_telp" id="no_telp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" class="form-control" value="<?= $get['no_telp'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Handphone</label>
						<input type="number" name="no_hp" id="no_hp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" class="form-control" value="<?= $get['no_hp'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Fax</label>
						<input type="text" name="no_fax" id="no_fax" class="form-control" value="<?= $get['no_fax'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" value="<?= $get['email'] ?>">
					</div>
					<div class="form-group col-md-4">
                        <label>Jenis Rujukan</label>
						<select name="jenis_rujukan" id="jenis_rujukan" class="form-control">
							<option value="" readonly selected>- Pilih Jenis Rujukan -</option>
							<option value="Rumah Sakit" <?= ($get['jenis_rujukan'] == "Rumah Sakit") ? 'selected' : ''; ?>>Rumah Sakit</option>
							<option value="Klinik" <?= ($get['jenis_rujukan'] == "Klinik") ? 'selected' : ''; ?>>Klinik</option>
							<option value="Puskesmas" <?= ($get['jenis_rujukan'] == "Puskesmas") ? 'selected' : ''; ?>>Puskesmas</option>
							<option value="Lainnya" <?= ($get['jenis_rujukan'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-4">
                        <label>Status</label>
                        <select class="form-control select2" name="status" id="Status"
                            style="width: 100%;">
                            <option value="Aktif" <?= ($get['status'] == "Aktif") ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Tidak Aktif" <?= ($get['status'] == "Tidak Aktif") ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>

                    <input type="hidden" name="modified_by" id="modified_by"
						value=<?= $this->session->userdata('username') ?>>
				<div class="col-md-12">
					<button type="button" class="btn btn-primary" id="addButton">Update</button>
					<a href="<?= base_url(); ?>rujukan" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>
	</div>

</div>

<script>
$(document).ready(function() {
    $('select').select2();
	// negara = $('#Cust_Country').val()
	// if (negara != 'Indonesia') {
	// 	$(".hd").css('display','none')
	// }else{
	// 	$(".hd").css('display','block')
	// }
	// $("#Cust_Country").change(function(){
	// 	negara = $(this).val()
	// 	if (negara != 'Indonesia') {
	// 		$(".hd").css('display','none')
	// 	}else{
	// 		$(".hd").css('display','block')
	// 	}
	// })
    $("#addButton").click(function () {
		if($('#nama_rujukan').val() == '' || $('#alamat').val() == '' || $('#no_telp').val() == '' || $('#no_hp').val() == '' || $('#no_fax').val() == '' || $('#email').val() == '' || $('#jenis_rujukan').val() == ''){
			swal("Gagal!", "Data tidak boleh kosong!", "error");
		}else{
        Swal.fire({
            title: "Are you sure?",
            html: 'Data rujukan akan diperbarui',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm!"
        }).then((result) => {
            if (result.value) {
				let kode_rujukan = $("#kode_rujukan").val();
                $.ajax({
                    url: "<?= base_url() ?>rujukan/update/"+kode_rujukan,
                    method: "POST",
                    data: $("form").serialize(),
                    success: function (res) {
                        $("form")[0].reset();
                        swal("Berhasil!", "Data rujukan berhasil diperbarui!", "success");
						setTimeout(function(){window.location.href="<?= base_url() ?>rujukan"} , 2000); 
                        // window.location.href = "<?= base_url() ?>rujukan";
                    }
                });
            }
        })
		}
    })
});
</script>