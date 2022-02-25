<div class="col-12">
	<div class="box">
		<div class="box-header">
			<h4 class="box-title">Tambah Supplier</h4>
		</div>
		<div class="box-body">
			<form method="POST">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Kode Supplier</label>
						<input type="text" name="Cust_Code" id="Cust_Code" class="form-control"
						value="SP-<?= $Cust_Code ?>" readonly>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Supplier</label>
						<input type="text" name="Cust_Name" id="Cust_Name" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat 1</label>
						<input type="text" name="Cust_Address1" id="Cust_Address1" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat 2</label>
						<input type="text" name="Cust_Address2" id="Cust_Address2" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="Cust_City" id="Cust_City" style="width: 100%;">
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
					<div class="form-group col-md-4">
						<label>Provinsi</label>
						<select class="form-control select2" name="Cust_Prov" id="Cust_Prov" style="width: 100%;">
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
					<div class="form-group col-md-4">
						<label>Negara</label>
						<input type="text" class="form-control" name="Cust_Country" value="Indonesia" readonly>
						<!-- <select class="form-control select2" name="Cust_Country" id="Cust_Country" style="width: 100%;">
							<?php  
                                foreach ($negara as $key => $row){
                                    if ($row['name'] == 'Indonesia'){
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
						<input type="text" name="Cust_Postal" id="Cust_Postal" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Telepon</label>
						<input type="number" name="Cust_Phone" id="Cust_Phone" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Handphone</label>
						<input type="number" name="Cust_Mobile" id="Cust_Mobile" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>FAX</label>
						<input type="text" name="Cust_Fax" id="Cust_Fax" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Email</label>
						<input type="email" name="Cust_email" id="Cust_email" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>No NPWP</label>
						<input type="text" name="NPWP_No" id="NPWP_No" class="form-control">
					</div>
					<div class="form-group col-md-4">
                        <label>Jenis Supplier</label>
						<select name="Cust_Jenis" id="Cust_Jenis" class="form-control">
							<option value="" readonly selected>- Pilih Jenis Supplier -</option>
							<option value="Obat-Obatan">Obat-Obatan</option>
							<option value="Alkes">Alkes</option>
							<option value="Lain-lain">Lain-lain</option>
						</select>
					</div>
					<div class="form-group col-md-4">
                        <label>Tipe Supplier</label>
						<select name="Cust_Type" id="Cust_Type" class="form-control">
							<option value="" readonly selected>- Pilih Tipe Supplier -</option>
							<option value="Perusahaan">Perusahaan</option>
							<option value="Apotik">Apotik</option>
							<option value="Pasien">Pasien</option>
							<option value="Lain-lain">Lain-lain</option>
						</select>
					</div>
					<div class="form-group col-md-4">
                        <label>Status</label>
                        <select class="form-control select2" name="Status" id="Status"
                            style="width: 100%;">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

				<input type="hidden" name="date_created" id="date_created" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="date_modified" id="date_modified" value="<?= date('Y-m-d H:i:s') ?>">
				<input type="hidden" name="created_by" id="created_by"
					value=<?= $this->session->userdata('username') ?>>
				<div class="col-md-12">
					<button type="button" class="btn btn-primary" id="addButton">Add Supplier</button>
					<a href="<?= base_url(); ?>supplier" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>
	</div>

</div>
<script>
$(document).ready(function() {
    $('select').select2();

    $("#addButton").click(function () {
        Swal.fire({
            title: "Are you sure?",
            html: 'Data supplier akan ditambahkan',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url() ?>supplier/save/",
                    method: "POST",
                    data: $("form").serialize(),
                    success: function (res) {
                        $("form")[0].reset();
                        swal("Berhasil!", "Data supplier tersimpan!", "success");
						setTimeout(function(){window.location.href="<?= base_url() ?>supplier"} , 2000); 
                        // window.location.href = "<?= base_url() ?>supplier";
                    }
                });
            }
        })
    })
});
</script>