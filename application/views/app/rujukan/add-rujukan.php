<div class="col-12">
	<div class="box">
		<div class="box-header">
			<h4 class="box-title">Tambah Rujukan</h4>
		</div>
		<div class="box-body">
			<form method="POST">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Kode Rujukan</label>
						<input type="text" name="kode_rujukan" id="kode_rujukan" class="form-control"
						value="RJ-<?= $kode_rujukan ?>" readonly>
					</div>
					<div class="form-group col-md-4">
						<label>Nama Rujukan</label>
						<input type="text" name="nama_rujukan" id="nama_rujukan" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control" id="alamat">
					</div>
					<div class="form-group col-md-4">
						<label>Kota/Kabupaten</label>
						<select class="form-control select2" name="kota" id="kota" style="width: 100%;">
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
						<select class="form-control select2" name="provinsi" id="provinsi" style="width: 100%;">
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
						<input type="text" class="form-control" name="negara" value="Indonesia" readonly>
						<!-- <select class="form-control select2" name="negara" id="negara" style="width: 100%;">
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
						<label>Telepon</label>
						<input type="number" name="no_telp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" id="no_telp" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Handphone</label>
						<input type="number" name="no_hp" id="no_hp" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Fax</label>
						<input type="text" name="no_fax" id="no_fax" maxlength="1"  class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control">
					</div>
					<div class="form-group col-md-4">
                        <label>Jenis Rujukan</label>
						<select name="jenis_rujukan" id="jenis_rujukan" class="form-control">
							<option value="" readonly selected>- Pilih Jenis Rujukan -</option>
							<option value="Rumah Sakit">Rumah Sakit</option>
							<option value="Klinik">Klinik</option>
							<option value="Puskesmas">Puskesmas</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group col-md-4">
                        <label>Status</label>
                        <select class="form-control select2" name="status" id="Status"
                            style="width: 100%;">
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                    </div>

                    <input type="hidden" name="date_modified" id="date_modified" value="<?= date('Y-m-d H:i:s') ?>">
                    <input type="hidden" name="created_by" id="created_by"
                        value=<?= $this->session->userdata('username') ?>>
				<div class="col-md-12">
					<button type="button" class="btn btn-primary" id="addButton">Save</button>
					<a href="<?= base_url(); ?>rujukan" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>
	</div>

</div>
<script>
$(document).ready(function() {
    $('select').select2();

    $("#addButton").click(function () {
		if($('#nama_rujukan').val() == '' || $('#alamat').val() == '' || $('#no_telp').val() == '' || $('#no_hp').val() == '' || $('#no_fax').val() == '' || $('#email').val() == '' || $('#jenis_rujukan').val() == ''){
			swal("Gagal!", "Data tidak boleh kosong!", "error");
		}else{
			Swal.fire({
            title: "Are you sure?",
            html: 'Data rujukan akan ditambahkan',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm!"
        	}).then((result) => {
			if(result.value) {
                $.ajax({
                    url: "<?= base_url() ?>rujukan/save/",
                    method: "POST",
                    data: $("form").serialize(),
                    success: function (res) {
                        $("form")[0].reset();
                        swal("Berhasil!", "Data rujukan tersimpan!", "success");
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