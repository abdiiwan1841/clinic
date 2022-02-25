<style>
    #hasilpencarian, #hasilpencarian2, #hasilpencarian3 { 
        padding: 0px; 
        display: none; 
        position: absolute; 
        max-height: 200px;
        width: 95%;
        overflow: auto;
        border:1px solid #ddd;
        z-index: 1;
    }

    #daftar-autocomplete, #daftar-autocomplete2, #daftar-autocomplete3{ 
        list-style:none; 
        margin:0; 
        padding:0; 
        width:100%;
    }

    #daftar-autocomplete li, #daftar-autocomplete2 li , #daftar-autocomplete3 li{
        padding: 5px 10px 5px 10px; 
        background:#FAFAFA; 
        border-bottom:#ddd 1px solid;
    }

    #daftar-autocomplete li:hover, 
    #daftar-autocomplete2 li:hover, 
    #daftar-autocomplete3 li:hover, 
    #daftar-autocomplete li.autocomplete_active  
    #daftar-autocomplete2 li.autocomplete_active2,
    #daftar-autocomplete3 li.autocomplete_active3 { 
        background:#6bb9f0; 
        color:#fff; 
        cursor: pointer;
    }
   .selectmodal {
        width: 100% !important;
    }
</style>
<!-- DATA PASIEN -->
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <h4 class="box-title">Data Pasien</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-sm btn-success" id="tambahPasien">Tambah Pasien</a>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCari">Cari Pasien</button>
                </div>
            </div>
		</div>
		<div class="box-body">
			<form method="POST">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>No MR</label>
                        <input type="text" name="mr_code" id="mrcode" class="form-control"
                        readonly placeholder="No MR">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama_pasien" id="nama_pasien" class="form-control"
                        value="" readonly placeholder="Nama Pasien">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="" id="jk" class="form-control"
                        value="" readonly placeholder="Jenis Kelamin">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tanggal Lahir</label>
                        <input type="text" name="" id="tgl_lahir" class="form-control"
                        value="" readonly placeholder="Tanggal Lahir">
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>
<!-- END DATA PASIEN -->

<!-- REGISTRASI -->
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
            <h4 class="box-title">Data Registrasi</h4>
		</div>
		<div class="box-body">
			<form method="POST">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>No Visit</label>
                        <input type="text" name="no_visit" id="novisit" class="form-control"
                        value="" readonly placeholder="No Visit">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Tanggal</label>
                        <input type="text" name="visit_date" value="<?= date("Y-m-d") ?>" id="visit_date" class="form-control" readonly>
                    </div>
                    <!-- <div class="offset-md-4"></div> -->
                    <div class="form-group col-md-4">
                        <label>Dokter Konsul</label>
                        <input type="hidden" id="kode_dokter" name="kode_dokter">
                        <input type="text" id="nama_dokter" name="nama_dokter" autocomplete="off" class="form-control" placeholder="Cari Dokter">
                        <div id="hasilpencarian"></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ref Dokter</label>
                        <input type="text" name="ref_nama_dokter" id="ref_nama_dokter" autocomplete="off" class="form-control"
                        value="" placeholder="Cari Dokter">
                        <input type="hidden" name="ref_kode_dokter" id="ref_kode_dokter" value="">
                        <div id="hasilpencarian2"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Diagnosa Khusus</label>
                        <select name="diagnosa_khusus" id="" class="form-control">
                            <option value="" selected readonly>- Pilih Diagnosa Khusus -</option>
                            <option value="Hepatitis B">Hepatitis B</option>
                            <option value="Hepatitis C">Hepatitis C</option>
                            <option value="SIFILIS">SIFILIS</option>
                            <option value="HIV">HIV</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Diagnosa Awal (ICD 10)</label>
                        <input type="hidden" id="icd" name="icd_code">
                        <input type="text" id="icd_code" class="form-control" autocomplete="off" placeholder="Cari Diagnosa Awal (ICD 10)">
                        <div id="hasilpencarian3"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Rujukan</label>
                        <select name="rujukan" id="" class="form-control">
                            <option value="">- Pilih Rujukan -</option>
                            <?php foreach($list_rujukan as $row){ ?>
                                <option value=""><?= $row['nama_rujukan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Keluhan</label>
                        <select name="keluhan[]" id="keluhan" data-placeholder="Pilih Keluhan"  multiple="multiple" class="form-control keluhan">
                            <?php foreach($list_keluhan as $row){ ?>
                                <option value="<?= $row['nama_keluhan'] ?>"><?= $row['nama_keluhan'] ?></option>
                            <?php } ?>
                        </select>
                        <!-- <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Keluhan"></textarea> -->
                    </div>
                    
                    <input type="hidden" name="no_antrian" id="noantrian" class="text-uppercase">
                    <input type="hidden" name="" id="noantrian2" value="<?= $noantrian ?>" class="form-control">
                    <input type="hidden" name="jam_antrian" id="" class="form-control" value="<?= date("H:i:sa") ?>";>
                    <input type="hidden" name="visit_time" id="" class="form-control" value="<?= date("H:i:sa") ?>";>
                    <input type="hidden" name="status_antrian" id="" class="form-control" value="Menunggu">
                    <input type="hidden" name="status" id="" class="form-control" value="Menunggu">
                    <input type="hidden" name="created_by" id="created_by" value=<?= $this->session->userdata('username') ?>>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" id="addButton">Save</button>
					    <a href="<?= base_url(); ?>registrasi" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
			</form>
		</div>
	</div>
</div>
<!-- END REGISTRASI -->

<!-- MODAL PASIEN -->
<div class="modal fade" id="modalCari">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Data Pasien</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table class="table" style="width: 100% !important;" id="example1">
                <thead>
                    <tr>
                        <th width="10">No.</th>
                        <th>No MR</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Lahir</th>
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
<!-- END MODAL PASIEN -->

<!-- Modal Add Pasien -->
<div class="modal fade" id="addPasienModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Pasien</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="col-md-12" id="show-add">
            <div class="box">
                <div class="box-body mt-3">
                    <form method="POST" id="form-pasien">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>MR Code</label>
                                <input type="text" name="MR_Code" id="MR_Code_New" class="form-control" value="<?= $MR_Code ?>"
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
                                <label>Agama</label><br>
                                <select name="Patient_Religion" id="Patient_Religion" class="form-control selectmodal" style="width: 100% !important;" style="width: 100% !important;">
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
                                <select name="Patient_Sex" id="Patient_Sex" class="form-control selectmodal" style="width: 100% !important;">
                                    <option value="" readonly selected>- Pilih Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status Pasien</label><br>
                                <select name="Patient_Status" id="Patient_Status" class="form-control selectmodal" style="width: 100% !important;">
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
                                <select class="form-control select2 selectmodal" style="width: 100% !important;" name="Patient_Country" id="Patient_Country"
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
                                <select class="form-control select2 selectmodal" style="width: 100% !important;" name="Patient_Prov" id="Patient_Prov" style="width: 100%;">
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
                                <select class="form-control select2 selectmodal" style="width: 100% !important;" name="Patient_City" id="Patient_City" style="width: 100%;">
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
                                <select class="form-control select2 kec selectmodal" style="width: 100% !important;" name="Patient_kec" id="Patient_kec"
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
                                <label>Pendidikan Terakhir</label><br>
                                <select class="form-control selectmodal" style="width: 100% !important;" name="Patient_Education" id="Patient_Education">
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
                                <select class="form-control select2 selectmodal" style="width: 100% !important;" name="Patient_Job" id="Patient_Job" style="width: 100%;">
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
                            <div class="form-group col-md-4">
                                <label>No BPJS</label>
                                <input type="number" name="Patient_BPJSNo" id="Patient_BPJSNo" class="form-control" maxlength="4">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Keterangan</label>
                                <input type="text" name="Patient_desc" id="Patient_desc" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Riwayat Alergi</label>
                                <select class="form-control selectmodal" style="width: 100% !important;" name="Patient_Special" id="Patient_Special">
                                    <option value="0">Tidak ada</option>
                                    <option value="1">Ada</option>
                                </select>
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
                            <button type="button" class="btn btn-primary" id="addPasien">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>  
</div>
<!-- END MODAL PASIEN -->
<!-- End Modal Pasien -->
<script>
$(document).ready(function() {
    $('select').select2();
    // setTimeout(() => {
    //     console.log()
       
    // }, 2000);
    $("#addButton").click(function () {
        if($('#mrcode').val() == ''){
            swal("Gagal!", "Silahkan pilih Pasien terlebih dahulu!", "error");
        }else if($('#novisit').val() == '' || $('#kode_dokter').val() == '' || $('#nama_dokter').val() == '' || $('#keluhan').val() == ''){
			swal("Gagal!", "Data tidak boleh kosong!", "error");
		}
        else{
			Swal.fire({
            title: "Are you sure?",
            html: 'Data registrasi akan ditambahkan',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonText: "Ya"
        	}).then((result) => {
			if(result.value) {
                $.ajax({
                    url: "<?= base_url() ?>registrasi/save/",
                    method: "POST",
                    data: $("form").serialize(),
                    success: function (res) {
                        $("form")[0].reset();
                        swal("Berhasil!", "Data registrasi tersimpan!", "success");
                        
						// setTimeout(function(){window.location.href="<?= base_url() ?>registrasi"} , 2000); 
                        // window.location.href = "<?= base_url() ?>rujukan";
                    }
                });
            }
        	})
		}
    })
});
</script>

<script>
$(document).ready(function() {
    $('select').select2();

    //datatables
    table = $('#example1').DataTable({ 
 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
        
        "ajax": {
            "url": "<?php echo site_url('registrasi/get_data_pasien')?>",
            "type": "POST"
        },

        
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],

    });

    $("tbody").on("click",".pilihpasien", function(){
        var novisit = $(this).attr('novisit');
        var mrcode = $(this).attr('mrcode');
        $("#novisit").val('RJ-'+mrcode+'-'+novisit);
        $("#mrcode").val($(this).attr('mrcode'));
        $("#nama_pasien").val($(this).attr('nama_pasien'));
        $("#jk").val($(this).attr('jk'));
        $("#tgl_lahir").val($(this).attr('tgl_lahir'));

        $.ajax({
            url:  '<?php echo site_url('registrasi/get_registrasi/')?>'+ mrcode,
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                for (let x = 0; x < data.length; x++) {
                    if(data[x].status == 'Menunggu'){
                        swal("Gagal!", "Pasien sedang melakukan konsultasi!", "error");
                        $('form').trigger("reset");
                    }
                }
            },
            err(e) {
                console.log(e)
            }
        })
    })

}); 
</script>

<!-- DOKTER -->

<script>
    $(document).on('keyup', '#nama_dokter', function(e){
        var keyword = $("#nama_dokter").val();
        if(keyword !== ""){
            var charcode = e.which || e.keyCode;
            $.ajax({
                url: "<?php echo base_url(); ?>registrasi/cari_dokter",
                type: "post",
                cache: false,
                data: "like=" + keyword,
                dataType: "json",
                success: function(json){
                    if(json.status == 1){
                        $("#hasilpencarian").show();
                        $("#hasilpencarian").html(json.datanya);
                    }
                }
            });       
        }else{
            $("#hasilpencarian").hide();      
        }
    });

    $(document).on("click", "#daftar-autocomplete li", function(){
        var kode_dokter = $(this).find("span#kode_dokter").html();
        var doktershow = $(this).find("span#doktershow").html();

        $("#kode_dokter").val(kode_dokter);
        $("#nama_dokter").val(doktershow);
        $("#ref_kode_dokter").val(kode_dokter);
        $("#ref_nama_dokter").val(doktershow);

        var kodedokter = $("#kode_dokter").val().substr(0, 3);
        var noantrian = $("#noantrian2").val();

        $("#noantrian").val(kodedokter+'-'+noantrian);
        $("#hasilpencarian").hide();
    });


    $(document).ready(function(){
        $(document).click(function(){
            $("#hasilpencarian").hide();
        });
    });
</script>

<script>
    $(document).on('keyup', '#ref_nama_dokter', function(e){
        var keyword = $("#ref_nama_dokter").val();
        if(keyword !== ""){
            var charcode = e.which || e.keyCode;
            $.ajax({
                url: "<?php echo base_url(); ?>registrasi/cari_dokter_ref",
                type: "post",
                cache: false,
                data: "like=" + keyword,
                dataType: "json",
                success: function(json){
                    if(json.status == 1){
                        $("#hasilpencarian2").show();
                        $("#hasilpencarian2").html(json.datanya);
                    }
                }
            });       
        }else{
            $("#hasilpencarian2").hide();      
        }
    });

    $(document).on("click", "#daftar-autocomplete2 li", function(){
        var ref_kode_dokter = $(this).find("span#ref_kode_dokter").html();
        var refdoktershow = $(this).find("span#refdoktershow").html();

        $("#ref_nama_dokter").val(refdoktershow);
        $("#ref_kode_dokter").val(ref_kode_dokter);
        
        $("#hasilpencarian2").hide();
    });


    $(document).ready(function(){
        $(document).click(function(){
            $("#hasilpencarian2").hide();
        });
    });
</script>

<!-- END DOKTER -->

<!-- ICD 10 -->

<script>
    $(document).on('keyup', '#icd_code', function(e){
        var keyword = $("#icd_code").val();
        if(keyword !== ""){
            var charcode = e.which || e.keyCode;
            $.ajax({
                url: "<?php echo base_url(); ?>registrasi/cari_icd",
                type: "post",
                cache: false,
                data: "like=" + keyword,
                dataType: "json",
                success: function(json){
                    if(json.status == 1){
                        $("#hasilpencarian3").show();
                        $("#hasilpencarian3").html(json.datanya);
                    }
                }
            });       
        }else{
            $("#hasilpencarian3").hide();      
        }
    });

    $(document).on("click", "#daftar-autocomplete3 li", function(){
        var icd_code = $(this).find("span#icd_code").html();
        var icdshow = $(this).find("span#icdshow").html();

        $("#icd").val(icd_code);
        $("#icd_code").val(icdshow);
        $("#hasilpencarian3").hide();
    });


    $(document).ready(function(){
        $(document).click(function(){
            $("#hasilpencarian3").hide();
        });
    });
    $(document).ready(function(){
        
        $("#tambahPasien").click(function (e) {
            e.preventDefault()
            $('.selectmodal').select2({
                dropdownParent: $('#addPasienModal')
            });
            $('#addPasienModal').modal({backdrop: 'static', keyboard: false})  
            $('#addPasienModal').modal('show')
        })
        $("#addPasien").click(function () {
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
							url: "<?=base_url()?>pasien/save_pasien_registrasi/",
							method: "POST",
							data: $("form").serialize(),
							success: function (res) {
                                console.log(res)
                                data = res.split("|")
                                console.log(data)
                                var mr_code = data[0];
                                var novisit = data[1];
                                var tgl_lahir = data[2];
                                var nama_pasien = data[3];
                                var jk = data[4];
                                $("#novisit").val('RJ-'+mr_code+'-'+novisit);
                                $("#mrcode").val(data[0]);
                                $("#nama_pasien").val(data[3]);
                                $("#jk").val(data[4]);
                                $("#tgl_lahir").val(data[2]);
                                $.ajax({
                                    url:  '<?php echo site_url('registrasi/get_registrasi/')?>'+ mr_code,
                                    method: 'POST',
                                    dataType: 'json',
                                    success: function(data) {
                                        for (let x = 0; x < data.length; x++) {
                                            if(data[x].status == 'Menunggu'){
                                                swal("Gagal!", "Pasien sedang melakukan konsultasi!", "error");
                                                $('form').trigger("reset");
                                            }
                                        }
                                    },
                                    err(e) {
                                        console.log(e)
                                    }
                                })
								$("#form-pasien")[0].reset();
                                $("#MR_Code_New").val(data[5])

                                $('#addPasienModal').modal('hide')
								swal("Berhasil!", "Data pasien tersimpan!", "success");
								// location.reload();
							},error(e){
                                console.log(e)
                            }
						});
					}
				})
			}
		})
    })
</script>
<!-- END ICD 10 -->