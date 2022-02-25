<div class="col-12">
	<div class="box">
		<div class="box-header">
			<h4 class="box-title">Edit Supplier</h4>
		</div>
		<div class="box-body">
			<form method="POST">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Kode Supplier</label>
						<input type="text" name="Cust_Code" id="Cust_Code" class="form-control"
							value="<?= $data_supp['Cust_Code'] ?>" readonly>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Supplier</label>
						<input type="text" name="Cust_Name" id="Cust_Name" class="form-control" value="<?= $data_supp['Cust_Name'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat 1</label>
						<input type="text" name="Cust_Address1" id="Cust_Address1" class="form-control" value="<?= $data_supp['Cust_Address1'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat 2</label>
						<input type="text" name="Cust_Address2" id="Cust_Address2" class="form-control" value="<?= $data_supp['Cust_Address2'] ?>">
					</div>
					<div class="form-group col-md-4 hd">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="Cust_City" id="Cust_City" style="width: 100%;">
							<?php  
								foreach ($kota as $key => $row){
									if ($row == $data_supp['Cust_City']){
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
						<select class="form-control select2" name="Cust_Prov" id="Cust_Prov" style="width: 100%;">
							<?php  
								foreach ($provinsi as $key => $row){
									if ($row == $data_supp['Cust_Prov']){
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
						<input type="text" class="form-control" name="Cust_Country" value="<?= $data_supp['Cust_Country'] ?>" readonly>
						<!-- <select class="form-control select2" name="Cust_Country" id="Cust_Country" style="width: 100%;">
							<?php  
								foreach ($negara as $key => $row){
									if ($row['name'] == $data_supp['Cust_Country']){
										echo "<option value='".$row['name']."' selected>".$row['name']."</option>";
									}else{
										echo "<option value='".$row['name']."'>".$row['name']."</option>";
									}
								} 
							?>
						</select> -->
					</div>
					<div class="form-group col-md-4">
						<label>Kode POS</label>
						<input type="text" name="Cust_Postal" id="Cust_Postal" class="form-control" value="<?= $data_supp['Cust_Postal'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Telepon</label>
						<input type="number" name="Cust_Phone" id="Cust_Phone" class="form-control" value="<?= $data_supp['Cust_Phone'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Handphone</label>
						<input type="number" name="Cust_Mobile" id="Cust_Mobile" class="form-control" value="<?= $data_supp['Cust_Mobile'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>FAX</label>
						<input type="text" name="Cust_Fax" id="Cust_Fax" class="form-control" value="<?= $data_supp['Cust_Fax'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>Email</label>
						<input type="email" name="Cust_email" id="Cust_email" class="form-control" value="<?= $data_supp['Cust_email'] ?>">
					</div>
					<div class="form-group col-md-4">
						<label>No NPWP</label>
						<input type="text" name="NPWP_No" id="NPWP_No" class="form-control" value="<?= $data_supp['NPWP_No'] ?>">
					</div>
					<!-- <div class="form-group col-md-4">
						<label>Jenis</label>
						<select name="Patient_Sex" id="Patient_Sex" class="form-control">
							<option value="" readonly selected>--Pilih--</option>
							<option value="Perusahaan">Perusahaan</option>
							<option value="Apotik">Apotik</option>
							<option value="Lain-lain">Lain-lain</option>
						</select>
					</div> -->
					<div class="form-group col-md-4">
                        <label>Jenis Supplier</label>
						<select name="Cust_Jenis" id="Cust_Jenis" class="form-control">
							<option value="" readonly selected>- Pilih Jenis Supplier -</option>
							<option value="Obat-Obatan" <?= ($data_supp['Cust_Jenis'] == "Obat-Obatan") ? 'selected' : ''; ?>>Obat-Obatan</option>
							<option value="Alkes" <?= ($data_supp['Cust_Jenis'] == "Alkes") ? 'selected' : ''; ?>>Alkes</option>
							<option value="Lain-lain" <?= ($data_supp['Cust_Jenis'] == "Lain-lain") ? 'selected' : ''; ?>>Lain-lain</option>
						</select>
					</div>
					<div class="form-group col-md-4">
                        <label>Tipe Supplier</label>
						<select name="Cust_Type" id="Cust_Type" class="form-control">
							<option value="" readonly selected>- Pilih Tipe Supplier -</option>
							<option value="Perusahaan" <?= ($data_supp['Cust_Type'] == "Perusahaan") ? 'selected' : ''; ?>>Perusahaan</option>
							<option value="Apotik" <?= ($data_supp['Cust_Type'] == "Apotik") ? 'selected' : ''; ?>>Apotik</option>
							<option value="Pasien" <?= ($data_supp['Cust_Type'] == "Pasien") ? 'selected' : ''; ?>>Pasien</option>
							<option value="Lain-lain" <?= ($data_supp['Cust_Type'] == "Lain-lain") ? 'selected' : ''; ?>>Lain-lain</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label>Status</label>
						<select class="form-control" name="Status" id="Status"
							style="width: 100%;">
							<option value="Aktif" <?= ($data_supp['Status'] == "Aktif") ? 'selected' : ''; ?>>Aktif</option>
							<option value="Non Aktif" <?= ($data_supp['Status'] == "Tidak Aktif") ? 'selected' : ''; ?>>Tidak Aktif</option>
						</select>
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-primary" id="addButton">Edit Supplier</button>
						<a href="<?= base_url(); ?>supplier" class="btn btn-danger">Cancel</a>
					</div>

					<input type="hidden" name="date_created" id="date_created" value="<?= date('Y-m-d H:i:s') ?>">
					<input type="hidden" name="date_modified" id="date_modified" value="<?= date('Y-m-d H:i:s') ?>">
					<input type="hidden" name="created_by" id="created_by"
						value=<?= $this->session->userdata('username') ?>>
					<input type="hidden" name="modified_by" id="modified_by"
						value=<?= $this->session->userdata('username') ?>>
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
        Swal.fire({
            title: "Are you sure?",
            html: 'Data supplier akan diperbarui',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm!"
        }).then((result) => {
            if (result.value) {
				let Cust_Code = $("#Cust_Code").val();
                $.ajax({
                    url: "<?= base_url() ?>supplier/update_rm/"+Cust_Code,
                    method: "POST",
                    data: $("form").serialize(),
                    success: function (res) {
                        $("form")[0].reset();
                        swal("Berhasil!", "Data supplier berhasil diperbarui!", "success");
						setTimeout(function(){window.location.href="<?= base_url() ?>supplier"} , 2000); 
                        // window.location.href = "<?= base_url() ?>supplier";
                    }
                });
            }
        })
    })
});
</script>