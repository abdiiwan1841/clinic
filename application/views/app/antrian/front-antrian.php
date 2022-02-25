<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="icon" href="https://www.multipurposethemes.com/admin/webkitx-admin-template/images/favicon.ico"> -->

	<title><?= $title; ?></title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/vendors_css.css">
	<link href="<?= base_url() ?>assets/css/sweetalert2.css" rel="stylesheet">

	<!-- Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/skin_color.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/color_theme.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select.css">
	<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.all.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.js"></script>
    <style>
        .footer{
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #fff;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm bg-white">
            <a class="navbar-brand" href="#">
                <img src="https://www.rsiastellamaris.com/assets/images/logo.png" alt="" width="240">
            </a>
            <div class="ml-auto pr-3">
                <h2 class="mb-0 text-primary digital-clock"><?= date("H:i:s") ?></h2>
                <h4 style="font-size:22px"><?= date("d M Y") ?></h4>
            </div>
        </nav>
    </header>

    <div class="row">
        <div class="container-fluid py-4">
            <div class="row pr-3 pl-3 ">
                <div class="col-md-6 text-center">
                    <div class="box box-solid bg-primary mb-3">
                        <div class="box-header py-2">
                            <h2 class="text-uppercase">Antrian - poli anak</h2>
                        </div>

                        <div class="box-body">
                            <h1 class="text-primary mb-2" style="font-size:70px;"><b>TFI-001</b></h1>
                            <h3 class="mt-0 mb-3"><b>Dr.dr.Bugis Mardina Lubis,M.Ked(Ped), SpA(K)</b></h3>
                        </div>
                    </div>

                </div>


                <div class="col-md-6">
                    <iframe width="100%" height="240" src="https://www.youtube.com/embed/Hgq1LoAqMgg?rel=0&autoplay=1&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>

                <div class="col-md-6">
                    <div class="box box-solid bg-danger mb-3">
                        <div class="box-header py-1 text-center">
                            <h3 class="text-uppercase" style="font-size:20px;">Antrian Poli Selanjutnya</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded p-1 b-1 mb-2">
                        <h1 class="text-danger ml-3" style="font-size:25px;"><span class="mr-3">1.</span>TFI-001</h1>
                    </div>
                    <div class="bg-white rounded p-1 b-1 mb-2">
                        <h1 class="text-danger ml-3" style="font-size:25px;"><span class="mr-3">2.</span>TFI-002</h1>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-solid bg-primary mb-3">
                                <div class="box-header py-1 text-center">
                                    <h3 class="text-uppercase" style="font-size:20px;">Antrian Farmasi</h3>
                                </div>
                            </div>
                            <div class="bg-white rounded p-1 b-1 mb-2">
                                <h1 class="text-primary ml-3" style="font-size:25px;"><span class="mr-3">1.</span>TFI-001</h1>
                            </div>
                            <div class="bg-white rounded p-1 b-1 mb-2">
                                <h1 class="text-primary ml-3" style="font-size:25px;"><span class="mr-3">2.</span>TFI-002</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-solid bg-success mb-3">
                                <div class="box-header py-1 text-center">
                                    <h3 class="text-uppercase" style="font-size:20px;">Antrian Kasir</h3>
                                </div>
                            </div>
                            <div class="bg-white rounded p-1 b-1 mb-2">
                                <h1 class="text-success ml-3" style="font-size:25px;"><span class="mr-3">1.</span>TFI-001</h1>
                            </div>
                            <div class="bg-white rounded p-1 b-1 mb-2">
                                <h1 class="text-success ml-3" style="font-size:25px;"><span class="mr-3">2.</span>TFI-002</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <footer class="footer" style="height:65px;">
      <div class="container-fluid py-2">
        <marquee direction="left"><h3 class="mb-0 text-success">"Covid-19 tidak mengenal usia, tidak mengenal jabatan, tidak mengenal siapapun, dia hanya mengenal orang-orang yang tidak pakai masker"</h3></marquee>
      </div>
    </footer>

    	<!-- Vendor JS -->
	<script src="<?= base_url() ?>assets/js/vendors.min.js"></script>
	<script src="<?= base_url() ?>assets/js/pages/chat-popup.js"></script>
	<script src="<?= base_url() ?>assets/icons/feather-icons/feather.min.js"></script>

	<script src="<?= base_url() ?>assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<script src="<?= base_url() ?>assets/vendor_components/datatable/datatables.min.js"></script>
	<!-- <script src="<?= base_url() ?>assets/js/fontawesome.all.min.js"></script> -->
	<script src="<?= base_url() ?>assets/js/sweetalert2.js"></script>
	<script src="<?= base_url() ?>assets/js/function.js"></script>

	<!-- WebkitX Admin App -->
	<script src="<?= base_url() ?>assets/js/bootstrap-select.js"></script>
	<script src="<?= base_url() ?>assets/vendor_components/select2/dist/js/select2.full.js"></script>
	<script src="<?= base_url() ?>assets/js/template.js"></script>
	<script src="<?= base_url() ?>assets/js/pages/data-table.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
    <script>
    $(document).ready(function() {
        clockUpdate();
        setInterval(clockUpdate, 1000);
        })

        function clockUpdate() {
        var date = new Date();
        $('.digital-clock');
        function addZero(x) {
            if (x < 10) {
            return x = '0' + x;
            } else {
            return x;
            }
        }

        function twelveHour(x) {
            if (x > 12) {
            return x = x - 12;
            } else if (x == 0) {
            return x = 12;
            } else {
            return x;
            }
        }

        var h = addZero(date.getHours());
        var m = addZero(date.getMinutes());
        var s = addZero(date.getSeconds());

        $('.digital-clock').text(h + ':' + m + ':' + s)
        }
    </script>

</body>
</html>
