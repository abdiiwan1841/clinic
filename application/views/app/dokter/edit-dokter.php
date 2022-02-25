<div class="col-12">
    <form action="POST" id="form-dokter">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Edit Dokter</h4>  
        </div>
        <div class="box-body row">
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kode Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input type="hidden" name="original_value" id="original_value" value="<?=$dokter['kode_dokter']?>"> 
                    <input type="hidden" name="original_value2" id="original_value2" value="<?=$dokter['kode_prefix']?>"> 
                    <input class="form-control" readonly type="text" value="<?=$dokter['kode_dokter']?>" placeholder="Cth :OBG" name="kode_dokter" tab-index="0" id="kode_dokter">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Nama Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control" type="text" placeholder="Cth : Dr.Bambang Sp.OGs" name="nama_dokter"  id="nama_dokter" value="<?=$dokter['nama_dokter']?>" tab-index="1">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Tanggal Lahir Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control datepicker" value="<?=$dokter['dob_dokter']?>" type="date" name="dob_dokter" id="dob_dokter" tab-index="4">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label>Agama <small class="text-danger">*</small></label>
                <select class="form-control select2"    name="agama_dokter" id="agama_dokter" style="width: 100%;">
                    <option <?php if($dokter['agama_dokter'] == 'Islam') echo 'selected' ?> value="Islam">Islam</option>
                    <option <?php if($dokter['agama_dokter'] == 'Katolik') echo 'selected' ?>  value="Katolik">Katolik</option>
                    <option <?php if($dokter['agama_dokter'] == 'Protestan') echo 'selected' ?>  value="Protestan">Protestan</option>
                    <option <?php if($dokter['agama_dokter'] == 'Budha') echo 'selected' ?>  value="Budha">Budha</option>
                    <option <?php if($dokter['agama_dokter'] == 'Hindu') echo 'selected' ?>  value="Hindu">Hindu</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Kode Spesialis <small class="text-danger">*</small></label>
                <select name="kode_spesialis" id="kode_spesialis" class="form-control select2" data-live-search="true">
                    <?php 
                    foreach ($list_spesialis->result_array() as $spesialis) {
                        ?>
                        <option <?php if($dokter['kode_spesialis'] == $spesialis['kode_spesialis']) echo 'selected' ?>  value="<?=$spesialis['kode_spesialis']?>"><?=$spesialis['nama_spesialis']?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label>Poli</label>
                <input type="hidden" name="kode_poli" id="kode_poli">
                <select name="poli[]" id="poli" data-placeholder="Pilih poli"  multiple="multiple" class="form-control select2 poli">
                    <?php foreach($poli as $row){ ?>
                        <option value="<?= $row['kode_poli'] ?>"><?= $row['nama_poli'] ?></option>
                    <?php } ?>
                </select>
                <!-- <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Keluhan"></textarea> -->
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Kode Prefix (Min 3, Maks 4)</label>
                <div class="">
                    <input class="form-control" value="<?=$dokter['kode_prefix']?>" type="text" name="kode_prefix" tab-index="2">
                </div>
            </div>
            <!-- <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kelas Dokter</label>
                <div class="">
                    <input class="form-control" value="<?=$dokter['kelas_dokter']?>" type="text" name="kelas_dokter" tab-index="2">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">ID Dokter </label>
                <div class="">
                    <input class="form-control" type="text" value="<?=$dokter['id_dokter']?>" name="id_dokter" tab-index="3">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kode Menkes </label>
                <div class="">
                    <input class="form-control" type="text" value="<?=$dokter['kode_menkes']?>" name="kode_menkes" tab-index="3">
                </div>
            </div> -->
            
           
            <!-- <div class="form-group col-md-4 col-12">
                <label>Provinsi <small class="text-danger">*</small></label>
                <select class="form-control select2" tab-index="6"  name="provinsi_dokter" id="provinsi_dokter" style="width: 100%;">
                    <?php  
                        foreach ($provinsi as $key => $row){
                            if ($row == $dokter['provinsi_dokter']){
                                echo "<option value='$row' selected>$row</option>";
                            }else{
                                echo "<option value='$row'>$row</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label>Kota/Kabupaten <small class="text-danger">*</small></label>
                <select class="form-control select2"  tab-index="7" name="kota_dokter" id="kota_dokter" style="width: 100%;">
                    <?php  
                        foreach ($kota as $key => $row){
                            if ($row == $dokter['kota_dokter']){
                                echo "<option value='$row' selected>$row</option>";
                            }else{
                                echo "<option value='$row'>$row</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label>Kecamatan <small class="text-danger">*</small></label>
                <select class="form-control select2 kec" tab-index="8" name="kecamatan_dokter" id="kecamatan_dokter"
                    style="width: 100%;">
                    <?php  
                        foreach ($kecamatan as $key => $row){
                            if ($row == $dokter['kecamatan_dokter']){
                                echo "<option value='$row' selected>$row</option>";
                            }else{
                                echo "<option value='$row'>$row</option>";
                            }
                        } 
                    ?>
                </select>
            </div> -->
            <div class="form-group col-md-12 col-12">
                <label class="col-form-label">Alamat Dokter <small class="text-danger">*</small></label>
                <textarea name="alamat_dokter" id="alamat_dokter" value="<?=$dokter['alamat_dokter']?>" cols="30" rows="4" tab-index="5" class="form-control"><?=$dokter['alamat_dokter']?></textarea>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Telepon 1 <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control" type="text" value="<?=$dokter['telp1_dokter']?>"  tab-index="9" name="telp1_dokter" tab-index="0">
                </div>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Telepon 2</label>
                <div class="">
                    <input class="form-control" type="text" value="<?=$dokter['telp2_dokter']?>"  tab-index="10" name="telp2_dokter" tab-index="0">
                </div>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Status</label>
                <select name="status" id="status" class="form-control">
                        <option value="Aktif" <?php if($dokter['status'] == 'Aktif') echo 'selected' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?php if($dokter['status'] == 'Tidak Aktif') echo 'selected' ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="col-12 text-center mt-3">
                <a href="<?=base_url()?>dokter" class="btn btn-secondary mr-2">Batal</a>
                <button class="btn btn-primary mr-2 submit-btn">Ubah Dokter</button>
            </div>
        </div>
    </div>
    </form>    
    
</div>
<script>
$(document).ready(function() {
    $('select').select2();
    $('.kec').select2({
        minimumInputLength: 3
    });
    $poli = "<?=$dokter['kode_poli']?>"
    $currentPoli = $poli.split(",");
    console.log($currentPoli.length)
    if($currentPoli.length > 0){
        $("#poli").val($currentPoli).trigger('change');
    }
    $(document).on('click', ".submit-btn", function(e) {
        e.preventDefault()
        var kode_dokter = $('#kode_dokter').val();
        var original_value = $('#original_value').val();
        var ket = '';
        if(kode_dokter != original_value){
            ket = 'dan sebagai informasi, User login dokter akan otomatis diubah dengan username dan password baru adalah <strong>'+kode_dokter+'</strong>'
        }
        if(kode_dokter){
            Swal.fire({
                title: "Are you sure?",
                html: 'Data dokter akan diubah datanya '+ket,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    var kode_dokter = $('#kode_dokter').val();
                    $('#kode_poli').val($('#poli').val().join(","))
                    console.log($('#kode_poli').val())
                    var form_data = new FormData($('#form-dokter')[0])
                    $.ajax({
                        url: '<?= base_url() ?>dokter/edit_action',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(response) {
                            console.log(response)
                            message = response.split("|")
                            if (message[0] == 'Error') {
                                swalError("Gagal!", message[1], "error");
                            } else {
                                Swal.fire({
                                    type: "success",
                                    title: "Success",
                                    text: "Berhasil mengubah data dokter"
                                }).then(result => {

                                    window.location.href="<?=base_url()?>dokter"
                                });
                            }
                        },
                        error: function(err) {
                            console.log(err)
                            swalError('Error ' + err.status, err.statusText);
                        }
                    });
                }
            })
        }else{
            swalError("Tambah Dokter","Mohon isi kode dokter")
        }
        
    });

});
</script>