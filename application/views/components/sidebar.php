<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar">
		<div class="user-profile px-10 py-15">
			<div class="d-flex align-items-center">
				<div class="image">
					<img src="<?= base_url() ?>assets/images/avatar/avatar-13.png"
						class="avatar avatar-lg bg-primary-light" alt="User Image">
				</div>
				<div class="info ml-10">
					<p class="mb-0">Welcome</p>
					<h5 class="mb-0 text-capitalize"><?php echo $this->session->userdata('nama') ?></h5>
				</div>
			</div>
		</div>

		<!-- sidebar menu-->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
				<a href="<?= base_url(); ?>dashboard">
					<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="<?php if($this->uri->segment(1)=="registrasi"){echo "active";}?>">
				<a href="<?= base_url(); ?>registrasi">
					<i class="icon-Incoming-mail"><span class="path1"></span><span class="path2"></span></i>
					<span>Registrasi</span>
				</a>
			</li>
			<li class="<?php if($this->uri->segment(1)=="antrian"){echo "active";}?>">
				<a href="<?= base_url(); ?>antrian">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					<span>Antrian</span> <span class="badge badge-primary">20</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i span class="icon-Chat-locked"><span class="path1"></span><span class="path2"></span></i>
					<span>Keuangan</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kas Masuk</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kas Keluar</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembayaran Pembelian Obat</a></li>
					
				</ul>
			</li>
			<li class="treeview <?php if($this->uri->segment(1)=="data_obat" || $this->uri->segment(1)=="kategori_obat" || $this->uri->segment(1)=="satuan_obat"){echo "active";}?>">
				<a href="#">
					<i span class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
					<span>Apotik</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($this->uri->segment(1)=="data_obat"){echo "active";}?>"><a href="<?= base_url(); ?>data_obat"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Obat</a></li>
					<li class="<?php if($this->uri->segment(1)=="kategori_obat"){echo "active";}?>"><a href="<?= base_url(); ?>kategori_obat"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kategori Obat</a></li>
					<li class="<?php if($this->uri->segment(1)=="satuan_obat"){echo "active";}?>"><a href="<?= base_url(); ?>satuan_obat"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Satuan Obat</a></li>
					<li class="<?php if($this->uri->segment(1)=="antrian"){echo "active";}?>"><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembelian/Penerimaan Obat</a></li>
					<li class="<?php if($this->uri->segment(1)=="antrian"){echo "active";}?>"><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Penjualan Obat</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i span class="icon-Clipboard"><span class="path1"></span><span class="path2"></span></i>
					<span>Laporan</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pendaftaran Pasien</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Penerimaan Kasir</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembelian Obat</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pasien Rujukan</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Kas Masuk & Kas Keluar</a></li>
				</ul>
			</li>
			
			<li class="header">Billing</li>
			<li class="treeview">
				<a href="#">
					<i span class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
					<span>Billing Pasien</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembayaran</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembayaran Lain-lain</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pembatalan Pembayaran</a></li>
					<li><a href="<?= base_url(); ?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Cetak Ulang Pembayaran</a></li>
				</ul>
			</li>
			<li class="header">Master Data</li>
			<li class="treeview <?php if($this->uri->segment(1)=="pasien" || $this->uri->segment(1)=="dokter" || $this->uri->segment(1)=="poli" || $this->uri->segment(1)=="spesialis" || $this->uri->segment(1)=="supplier" || $this->uri->segment(1)=="rujukan"){echo "active";}?>">
				<a href="#">
					<i span class="icon-File"><span class="path1"></span><span class="path2"></span></i>
					<span>Master Data</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">

					<li class="<?php if($this->uri->segment(1)=="pasien"){echo "active";}?>"><a href="<?= base_url(); ?>pasien"><i class="icon-Commit"><span class="path1"></span><span
									class="path2"></span></i>Data Pasien</a></li>

					<li class="<?php if($this->uri->segment(1)=="dokter"){echo "active";}?>"><a href="<?= base_url(); ?>dokter"><i class="icon-Commit"><span class="path1"></span><span
									class="path2"></span></i>Data Dokter</a></li>

					<li class="<?php if($this->uri->segment(1)=="poli"){echo "active";}?>"><a href="<?= base_url(); ?>poli"><i class="icon-Commit"><span class="path1"></span><span
									class="path2"></span></i>Data Poli</a></li>

					<li class="<?php if($this->uri->segment(1)=="spesialis"){echo "active";}?>"><a href="<?= base_url(); ?>spesialis"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Spesialis</a></li>

					<li class="<?php if($this->uri->segment(1)=="keluhan"){echo "active";}?>"><a href="<?= base_url(); ?>keluhan"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Keluhan</a></li>

					<li class="treeview <?php if($this->uri->segment(1)=="diagnosa" || $this->uri->segment(1)=="tindakan"){echo "active";}?>">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Rekam Medis
							<span class="pull-right-container">
		              			<i class="fa fa-angle-right pull-right"></i>
		            		</span>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($this->uri->segment(1)=="diagnosa"){echo "active";}?>"><a href="<?= base_url() ?>diagnosa"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Diagnosa/ICD 10</a></li>

							<li class="<?php if($this->uri->segment(1)=="tindakan"){echo "active";}?>"><a href="<?= base_url() ?>tindakan"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Tindakan/ICD 9</a></li>
						</ul>
					</li>
					<li class="<?php if($this->uri->segment(1)=="supplier"){echo "active";}?>"><a href="<?= base_url(); ?>supplier"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Supplier</a></li>
					
					<li class="<?php if($this->uri->segment(1)=="rujukan"){echo "active";}?>"><a href="<?= base_url(); ?>rujukan"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rujukan</a></li>
				</ul>
			</li>
			<li>
				<a href="<?= base_url(); ?>">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					<span>Data Users</span>
				</a>
			</li>
			<li>
				<a href="<?= base_url(); ?>">
					<i class="icon-Settings-2"><span class="path1"></span><span class="path2"></span></i>
					<span>Setting</span>
				</a>
			</li>
		</ul>
	</section>
</aside>