<div class="col-md-12" id="show-add">
	<div class="box">
		<div class="box-body mt-3">
			<form method="POST">
				<div class="row">
					<div class="form-group col-md-3">
						<label>MR Code</label>
						<input type="text" name="MR_Code" id="MR_Code" class="form-control" value="<?= $MR_Code ?>"
							readonly>
					</div>
					<div class="form-group col-md-3">
						<label>No KTP</label>
						<input type="text" name="Patient_IC" id="Patient_IC" class="form-control">
					</div>
					<div class="form-group col-md-3">
						<label>Nama Depan</label>
						<input type="text" name="Patient_FName" id="Patient_FName" class="form-control" required>
					</div>
					<div class="form-group col-md-3">
						<label>Nama Belakang</label>
						<input type="text" name="Patient_LName" id="Patient_LName" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3">
						<label>Tanggal Lahir</label>
						<input type="date" name="Patient_DOB" id="Patient_DOB" class="form-control" required>
					</div>
					<div class="form-group col-md-3">
						<label>Agama</label>
						<select name="Patient_Religion" id="Patient_Religion" class="form-control select2">
							<option value="" readonly selected>- Pilih Agama -</option>
							<option value="Islam">Islam</option>
							<option value="Protestan">Protestan</option>
							<option value="Katolik">Katolik</option>
							<option value="Hindu">Hindu</option>
							<option value="Budha">Budha</option>
							<option value="Khonghucu">Khonghucu</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Jenis Kelamin</label>
						<select name="Patient_Sex" id="Patient_Sex" class="form-control select2">
							<option value="" readonly selected>- Pilih Jenis Kelamin -</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label>Status Pasien</label>
						<select name="Patient_Status" id="Patient_Status" class="form-control select2">
							<option value="" readonly selected>- Pilih Status -</option>
							<option value="Belum Menikah">Belum Menikah</option>
							<option value="Menikah">Menikah</option>
							<option value="Janda">Janda</option>
							<option value="Duda">Duda</option>
						</select>
						<!-- <input type="text" name="Patient_Status" id="Patient_Status" class="form-control"> -->
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6" required>
						<label>Alamat Pasien</label>
						<input type="text" name="Patient_Address" id="Patient_Address" class="form-control">
					</div>
					<div class="form-group col-md-3">
						<label>Negara</label>
						<select class="form-control select2" name="Patient_Country" id="Patient_Country"
							style="width: 100%;">
							<?php  
                                foreach ($negara as $key => $row){
                                    if ($row['name'] == 'Indonesia'){
                                        echo "<option value='".$row['name']."' selected>".$row['name']."</option>";
                                    }else{
                                        echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3 hd">
						<label>Provinsi</label>
						<select class="form-control select2" name="Patient_Prov" id="Patient_Prov" style="width: 100%;">
							<?php  
                                foreach ($provinsi as $key => $row){
                                    if ($row == 'Sumatera Utara'){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3 hd">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="Patient_City" id="Patient_City" style="width: 100%;">
							<?php  
                                foreach ($kota as $key => $row){
                                    if ($row == 'Medan'){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3 hd">
						<label>Kecamatan</label>
						<select class="form-control select2 kec" name="Patient_kec" id="Patient_kec"
							style="width: 100%;">
							<?php  
                                foreach ($kecamatan as $key => $row){
                                    if ($row == 'Medan Kota'){
                                        echo "<option value='$row' selected>$row</option>";
                                    }else{
                                        echo "<option value='$row'>$row</option>";
                                    }
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-3" required>
						<label>Telepon</label>
						<input type="text" name="Patient_Phone" id="Patient_Phone" class="form-control">
					</div>
					<div class="form-group col-md-3" required>
						<label>No Handphone</label>
						<input type="text" name="Patient_Mobile" id="Patient_Mobile" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label>Pendidikan Terakhir</label>
						<select class="form-control select2" name="Patient_Education" id="Patient_Education">
							<option value="" readonly selected>- Pilih Pendidikan Terakhir -</option>
							<option value="SD">SD</option>
							<option value="SMP">SMP</option>
							<option value="SMA/Sederajat">SMA/Sederajat</option>
							<option value="D-I">D-I</option>
							<option value="D-III">D-III</option>
							<option value="D-IV">D-IV</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Pekerjaan Terakhir</label>
						<select class="form-control select2" name="Patient_Job" id="Patient_Job" style="width: 100%;">
							<?php  
                                foreach ($pekerjaan as $key => $row){
									echo "<option value='$row'>$row</option>";
                                } 
                            ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Perusahaan</label>
						<input type="text" name="Patient_Company" id="Patient_Company" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3">
						<label>No BPJS</label>
						<input type="number" name="Patient_BPJSNo" id="Patient_BPJSNo" class="form-control" maxlength="4">
					</div>
					<div class="form-group col-md-3">
						<label>Keterangan</label>
						<input type="text" name="Patient_desc" id="Patient_desc" class="form-control">
					</div>
					<div class="form-group col-md-3">
						<label>Diagnosa Khusus</label>
						<select class="form-control select2" name="Patient_Special" id="Patient_Special">
							<option value="0">Tidak ada</option>
							<option value="1">Ada</option>
						</select>
						<div class="form-group mt-2 Patient_Type" style="display:none;">
							<select name="Patient_Type" id="Patient_Type" class="form-control select2" style=" width:100% !important">
								<option value="" selected readonly>- Pilih Diagnosa Khusus -</option>
								<option value="Hepatitis B">Hepatitis B</option>
								<option value="Hepatitis C">Hepatitis C</option>
								<option value="SIFILIS">SIFILIS</option>
								<option value="HIV">HIV</option>
							</select>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label>E-mail Pasien</label>
						<input type="text" name="Patient_Email" id="Patient_Email" class="form-control">
					</div>
				</div>
				<input type="hidden" name="date_created" id="date_created" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="date_modified" id="date_modified" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="created_by" id="created_by"
					value=<?= $this->session->userdata('username') ?>>
				<div class="col-md-12">
					<button type="button" class="btn btn-primary" id="addButton">Save</button>
					<button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
base_url = '<?= base_url() ?>';
$(document).ready(function(){
	$('select').select2();

    $("#Patient_Special").change(function(){
        if ($("#Patient_Special").val() == "1") {
            $(".Patient_Type").show();
        }else{
            $(".Patient_Type").hide();
        }
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
    $("#cancelButton").click(function(){
        window.location.href=base_url+"pasien";
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
                cancelButtonColor: "#d33"
                // confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    mr_code = $("#MR_Code").val();
                    $.ajax({
                        url: base_url + "pasien/save/",
                        method: "POST",
                        data: $("form").serialize(),
                        success: function (res) {
                            $("form")[0].reset();
                            swal("Berhasil!", "Data pasien tersimpan!", "success");
                            setTimeout(function(){window.location.href=base_url+"pasien"} , 2000); 
                        }
                    });
                }
            })
        }
    })
})
</script>