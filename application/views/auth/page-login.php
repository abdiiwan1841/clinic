<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.multipurposethemes.com/admin/webkitx-admin-template/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 02:55:42 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clinic - <?= $title; ?> </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/skin_color.css">	

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url('<?= base_url(); ?>assets/images/bg.png')">
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">SIMKLINIK 4.0</h2>
								<p class="mb-0">Enter your Account to get access.</p>							
							</div>
							<div class="p-40">
								<?php if($this->session->flashdata('message') == true){ ?>
	                                <div class="alert alert-danger">
	                                    <div class="d-flex align-items-center justify-content-start">
	                                        <span class="alert-icon">
	                                            <i class="anticon anticon-close-o"></i>
	                                        </span>
	                                        <span><?php echo $this->session->flashdata('message'); ?></span>
	                                    </div>
	                                </div>
	                            <?php } ?>
								<form method="post" action="<?php echo base_url();?>auth/login">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" class="form-control pl-15 bg-transparent" placeholder="Username" name="username">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent" placeholder="Password" name="password">
										</div>
									</div>
									  <div class="row">
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-primary btn-block mt-10">SIGN IN</button>
										  <p class="mt-4 text-center">Copyright ?? 2020 Clinic. All rights reserved</p>
										</div>
										<!-- /.col -->
									  </div>
								</form>	
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="<?= base_url() ?>assets/js/vendors.min.js"></script>
	<script src="<?= base_url() ?>assets/js/pages/chat-popup.js"></script>
    <script src="<?= base_url() ?>assets/icons/feather-icons/feather.min.js"></script>	

</body>

<!-- Mirrored from www.multipurposethemes.com/admin/webkitx-admin-template/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Aug 2020 02:55:42 GMT -->
</html>
