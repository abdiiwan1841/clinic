<div class="col-12">
    <form action="POST" id="form-dokter">
    <div class="box">
        <div class="box-header">
            <h4 class="box-title">Tambah Dokter</h4>  
        </div>
        <div class="box-body row">
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kode Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control" type="text" placeholder="Cth :OBG" name="kode_dokter" tab-index="0" id="kode_dokter">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Nama Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control" type="text" placeholder="Cth : Dr.Bambang Sp.OGs" name="nama_dokter"  id="nama_dokter"  tab-index="1">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Tanggal Lahir Dokter <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control datepicker" type="date" name="dob_dokter" id="dob_dokter" tab-index="4">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label>Agama <small class="text-danger">*</small></label>
                <select class="form-control select2"   name="agama_dokter" id="agama_dokter" style="width: 100%;">
                    <option value="Islam">Islam</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Kode Spesialis <small class="text-danger">*</small></label>
                <select name="kode_spesialis" id="kode_spesialis" class="form-control select2" data-live-search="true">
                    <?php 
                    foreach ($list_spesialis->result_array() as $spesialis) {
                        ?>
                        <option value="<?=$spesialis['kode_spesialis']?>"><?=$spesialis['nama_spesialis']?></option>
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
                    <input class="form-control" type="text" name="kode_prefix" tab-index="2">
                </div>
            </div>
            <!-- <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kelas Dokter</label>
                <div class="">
                    <input class="form-control" type="text" name="kelas_dokter" tab-index="2">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">ID Dokter </label>
                <div class="">
                    <input class="form-control" type="text" name="id_dokter" tab-index="3">
                </div>
            </div>
            <div class="form-group col-md-6 col-12">
                <label class="col-form-label">Kode Menkes </label>
                <div class="">
                    <input class="form-control" type="text" name="kode_menkes" tab-index="3">
                </div>
            </div> -->
            
           
            <!-- <div class="form-group col-md-4 col-12">
                <label>Provinsi <small class="text-danger">*</small></label>
                <select class="form-control select2" tab-index="6"  name="provinsi_dokter" id="provinsi_dokter" style="width: 100%;">
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
            <div class="form-group col-md-4 col-12">
                <label>Kota/Kabupaten <small class="text-danger">*</small></label>
                <select class="form-control select2"  tab-index="7" name="kota_dokter" id="kota_dokter" style="width: 100%;">
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
            <div class="form-group col-md-4 col-12">
                <label>Kecamatan <small class="text-danger">*</small></label>
                <select class="form-control select2 kec" tab-index="8" name="kecamatan_dokter" id="kecamatan_dokter"
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
            </div> -->
            <div class="form-group col-md-12 col-12">
                <label class="col-form-label">Alamat Dokter</label>
                <textarea name="alamat_dokter" id="alamat_dokter" cols="30" rows="4" tab-index="5" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Telepon 1 <small class="text-danger">*</small></label>
                <div class="">
                    <input class="form-control" type="text" tab-index="9" name="telp1_dokter" tab-index="0">
                </div>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Telepon 2</label>
                <div class="">
                    <input class="form-control" type="text" tab-index="10" name="telp2_dokter" tab-index="0">
                </div>
            </div>
            <div class="form-group col-md-4 col-12">
                <label class="col-form-label">Status</label>
                <select name="status" id="status" class="form-control select2" data-live-search="true">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="col-12 text-center mt-3">
                <a href="<?=base_url()?>dokter" class="btn btn-secondary mr-2">Batal</a>
                <button class="btn btn-primary mr-2 submit-btn">Tambah Dokter</button>
            </div>
        </div>
    </div>
    </form>    
    
</div>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $('.kec').select2({
        minimumInputLength: 3
    });
    $(document).on('click', ".submit-btn", function(e) {
        e.preventDefault()
        var kode_dokter = $('#kode_dokter').val();
        $('#kode_poli').val($('#poli').val().join(","))
        console.log($('#kode_poli').val())
        if(kode_dokter){
            Swal.fire({
                title: "Are you sure?",
                html: 'Data dokter akan ditambahkan dan sebagai informasi, User login dokter akan otomatis terbuat dengan username dan password adalah <strong>'+kode_dokter+'</strong>',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.value) {
                    var form_data = new FormData($('#form-dokter')[0])
                    $.ajax({
                        url: '<?= base_url() ?>dokter/add_dokter',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(response) {
                            message = response.split("|")
                            if (message[0] == 'Error') {
                                swalError("Gagal!", message[1], "error");
                            } else {
                                Swal.fire({
                                    type: "success",
                                    title: "Success",
                                    text: "Berhasil menambah data dokter"
                                }).then(result => {

                                    window.location.href="<?=base_url()?>dokter "
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