<div class="col-md-12" id="show-add">
	<div class="box">
		<div class="box-body mt-3">
			<form method="POST">
			<div class="row">
					<div class="form-group col-md-3">
						<label>MR Code</label>
						<input type="text" name="MR_Code" id="MR_Code" class="form-control" value="<?= $pasien['MR_Code'] ?>"
							readonly>
					</div>
					<div class="form-group col-md-3">
						<label>No KTP</label>
						<input type="text" name="Patient_IC" id="Patient_IC" class="form-control" value="<?= $pasien['Patient_IC'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>Nama Depan</label>
						<input type="text" name="Patient_FName" id="Patient_FName" class="form-control" required  value="<?= $pasien['Patient_FName'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>Nama Belakang</label>
						<input type="text" name="Patient_LName" id="Patient_LName" class="form-control" value="<?= $pasien['Patient_LName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3">
						<label>Tanggal Lahir</label>
						<input type="date" name="Patient_DOB" id="Patient_DOB" class="form-control" required value="<?= $pasien['Patient_DOB'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>Agama</label>
						<select name="Patient_Religion" id="Patient_Religion" class="form-control">
							<option value="Islam" <?= ($pasien['Patient_Religion'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
							<option value="Protestan" <?= ($pasien['Patient_Religion'] == 'Protestan') ? 'selected' : ''; ?>>Protestan</option>
							<option value="Katolik" <?= ($pasien['Patient_Religion'] == 'Katolik') ? 'selected' : ''; ?>>Katolik</option>
							<option value="Hindu" <?= ($pasien['Patient_Religion'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
							<option value="Budha" <?= ($pasien['Patient_Religion'] == 'Budha') ? 'selected' : ''; ?>>Budha</option>
							<option value="Khonghucu" <?= ($pasien['Patient_Religion'] == 'Khonghucu') ? 'selected' : ''; ?>>Khonghucu</option>
							<option value="Lainnya" <?= ($pasien['Patient_Religion'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Jenis Kelamin</label>
						<select name="Patient_Sex" id="Patient_Sex" class="form-control">
							<option value="Laki-laki" <?= ($pasien['Patient_Sex'] == 'Lainnya') ? 'selected' : ''; ?>>Laki-laki</option>
							<option value="Perempuan" <?= ($pasien['Patient_Sex'] == 'Lainnya') ? 'selected' : ''; ?>>Perempuan</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Status Pasien</label>
						<select name="Patient_Status" id="Patient_Status" class="form-control">
							<option value="Belum Menikah" <?= ($pasien['Patient_Status'] == 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
							<option value="Menikah" <?= ($pasien['Patient_Status'] == 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
							<option value="Janda" <?= ($pasien['Patient_Status'] == 'Janda') ? 'selected' : ''; ?>>Janda</option>
							<option value="Duda" <?= ($pasien['Patient_Status'] == 'Duda') ? 'selected' : ''; ?>>Duda</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6" required>
						<label>Alamat Pasien</label>
						<input type="text" name="Patient_Address" id="Patient_Address" class="form-control" value="<?= $pasien['Patient_Address'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>Negara</label>
						<select class="form-control select2" name="Patient_Country" id="Patient_Country"
							style="width: 100%;">
							<?php  
                                foreach ($negara as $key => $row){
                                    if ($row['name'] == $pasien['Patient_Country']){
                                        echo "<option value='".$row['name']."' selected>".$row['name']."</option>";
                                    }else{
                                        echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Provinsi</label>
						<select class="form-control select2" name="Patient_Prov" id="Patient_Prov" style="width: 100%;">
							<?php  
                                foreach ($provinsi as $key => $row){
                                    if ($row == $pasien['Patient_Prov']){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="Patient_City" id="Patient_City" style="width: 100%;">
							<?php  
                                foreach ($kota as $key => $row){
                                    if ($row == $pasien['Patient_City']){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Kecamatan</label>
						<select class="form-control select2 kec" name="Patient_kec" id="Patient_kec"
							style="width: 100%;">
							<?php  
                                foreach ($kecamatan as $key => $row){
                                    if ($row == $pasien['Patient_kec']){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Telepon</label>
						<input type="text" name="Patient_Phone" id="Patient_Phone" class="form-control" value="<?= $pasien['Patient_Phone'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>No Handphone</label>
						<input type="text" name="Patient_Mobile" id="Patient_Mobile" class="form-control" value="<?= $pasien['Patient_Mobile'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label>Pendidikan Terakhir</label>
						<select class="form-control" name="Patient_Education" id="Patient_Education">
							<option value="" readonly selected>- Pilih Pendidikan Terakhir -</option>
							<option value="SD" <?= ($pasien['Patient_Education'] == 'SD') ? 'selected' : ''; ?>>SD</option>
							<option value="SMP" <?= ($pasien['Patient_Education'] == 'SMP') ? 'selected' : ''; ?>>SMP</option>
							<option value="SMA/Sederajat" <?= ($pasien['Patient_Education'] == 'SMA/Sederajat') ? 'selected' : ''; ?>>SMA/Sederajat</option>
							<option value="D-I" <?= ($pasien['Patient_Education'] == 'D-I') ? 'selected' : ''; ?>>D-I</option>
							<option value="D-III" <?= ($pasien['Patient_Education'] == 'D-III') ? 'selected' : ''; ?>>D-III</option>
							<option value="D-IV" <?= ($pasien['Patient_Education'] == 'D-IV') ? 'selected' : ''; ?>>D-IV</option>
							<option value="S1" <?= ($pasien['Patient_Education'] == '"S1') ? 'selected' : ''; ?>>S1</option>
							<option value="S2" <?= ($pasien['Patient_Education'] == 'S2') ? 'selected' : ''; ?>>S2</option>
							<option value="S3" <?= ($pasien['Patient_Education'] == 'S3') ? 'selected' : ''; ?>>S3</option>
							<option value="Lainnya" <?= ($pasien['Patient_Education'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Pekerjaan Terakhir</label>
						<select class="form-control select2" name="Patient_Job" id="Patient_Job" style="width: 100%;">
							<?php  
								foreach ($pekerjaan as $key => $row){
									if ($row == $pasien['Patient_Job']){
										echo "<option value='$row' selected>$row</option>";
									}else{
										echo "<option value='$row'>$row</option>";
									}
								}
                            ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Perusahaan</label>
						<input type="text" name="Patient_Company" id="Patient_Company" class="form-control" value="<?= $pasien['Patient_Company'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label>No BPJS</label>
						<input type="text" name="Patient_BPJSNo" id="Patient_BPJSNo" class="form-control" value="<?= $pasien['Patient_BPJSNo'] ?>">
					</div>
					<div class="form-group col-md-3">
						<label>Keterangan</label>
						<input type="text" name="Patient_desc" id="Patient_desc" class="form-control" value="<?= $pasien['Patient_desc'] ?>">
					</div>
					<div class="form-group col-md-2">
						<label>Riwayat Alergi</label>
						<select class="form-control" name="Patient_Special" id="Patient_Special">
							<option value="0" <?= ($pasien['Patient_Special'] == '0') ? 'selected' : ''; ?>>Tidak ada</option>
							<option value="1" <?= ($pasien['Patient_Special'] == '1') ? 'selected' : ''; ?>>Ada</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>E-mail Pasien</label>
						<input type="text" name="Patient_Email" id="Patient_Email" class="form-control" value="<?= $pasien['Patient_Email'] ?>">
					</div>
				</div>
				<input type="hidden" name="date_created" id="date_created" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="date_modified" id="date_modified" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="created_by" id="created_by"
					value=<?= $this->session->userdata('username') ?>>
				<div>
					<div class="col-md-12">
						<button type="button" class="btn btn-primary" id="addButton" data-id='<?= $pasien['MR_Code'] ?>'>Ubah Pasien</button>
						<button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	base_url = "<?= base_url() ?>";
	$(document).ready(function () {
		$("#addButton").click(function () {
			if ($("#Patient_FName").val() == '' || $("#Patient_DOB").val() == '' || $("#Patient_Address").val() == '' || $("#Patient_Phone").val() == ''  || $("#Patient_Mobile").val() == '') {
				swal("Gagal!", "Data tidak boleh kosong!", "error");
			}else{
				Swal.fire({
					title: "Are you sure?",
					html: 'Data pasien akan diubah!</strong>',
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Confirm!"
				}).then((result) => {
					if (result.value) {
						let MR_Code = $(this).data('id')
						$.ajax({
							url: base_url + "pasien/save_edit/"+MR_Code,
							method: "POST",
							data: $("form").serialize(),
							success: function (res) {
								window.location.href= base_url+"pasien"
							}
						});
					}
				})
			}
		})
	})
</script>