<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$set = $this->func->globalset("semua");
$nama = (isset($titel)) ? $set->nama." &#8211; ".$titel: $set->nama." &#8211; ".$set->slogan;
$headerclass = (isset($titel)) ? "header-v4" : "";
$keranjang = (isset($_SESSION["usrid"]) AND $_SESSION["usrid"] > 0) ? $this->func->getKeranjang() : 0;
$keyw = $this->db->get("kategori");
$keywords = "";
foreach($keyw->result() as $key){ $keywords .= ",".$key->nama; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$nama?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="<?=base_url("cdn/assets/img/".$set->favicon)?>"/>
	<meta name="google-site-verification" content="G35UyHn6lX6mRzyFws0NJYYxHQp_aejuAFbagRKCL7c" />
	<meta name="description" content="Jual Khimar dan Dress dengan pilihan terlengkap serta menerima reseller" />
	<!--  Social tags      -->
	<meta name="keywords" content="Aplikasi toko online <?=$nama?>">
	<meta name="description" content="Aplikasi toko online <?=$nama?>">
	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?=$nama?> App By Masbil @masbil_al">
	<meta itemprop="description" content="Aplikasi toko online <?=$nama?>">
	<meta itemprop="image" content="<?=base_url("cdn/assets/img/".$set->favicon)?>">
	<!-- Twitter Card data -->
	<meta name="twitter:card" content="product">
	<meta name="twitter:site" content="@masbil_al">
	<meta name="twitter:title" content="<?=$nama?> App By Masbil @masbil_al">
	<meta name="twitter:description" content="Aplikasi toko online <?=$nama?>">
	<meta name="twitter:creator" content="@masbil_al">
	<meta name="twitter:image" content="<?=base_url("cdn/assets/img/".$set->favicon)?>">
	<!-- Open Graph data -->
	<meta property="fb:app_id" content="655968634437471">
	<meta property="og:title" content="<?=$nama?> App By Masbil @masbil_al" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?=base_url()?>" />
	<meta property="og:image" content="<?=base_url("cdn/assets/img/".$set->favicon)?>" />
	<meta property="og:description" content="Aplikasi toko online <?=$nama?>" />
	<meta property="og:site_name" content="<?=$nama?> App By Masbil @masbil_al" />
<!--===============================================================================================-->
	<!-- <link rel="icon" type="image/png" href="<?= base_url('assets/images/icons/favicon.png') ?>"/> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/animate/animate.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/animsition/css/animsition.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/select2/select2.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/daterangepicker/daterangepicker.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/slick/slick.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/css-hamburgers/hamburgers.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/lightbox2/css/lightbox.min.css') ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/utility.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main_an.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fixer.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/masbilfix.css?v='.time()) ?>">
	<!--link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom.css') ?>"-->
<!--===============================================================================================-->


<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>

	<!-- GENERATED CUSTOM COLOR -->
	<style rel="stylesheet">
		.colorw{
			color: #fff;
		}
		a:hover,
		.color1{
			color: <?=$set->color1?>;
		}
		.color2{
			color: <?=$set->color2?>;
		}
		.cat-item .nama{
			background: rgba(<?=$set->color1rgba?>,0.75);
		}
		.cat-bg:hover > .nama{
			background: <?=$set->color1?>;
		}
		.bg-1,
		.tab-riwayat .nav-tabs .nav-link.active,
		.header-icons-noti{
			background-color: <?=$set->color1?>;
		}
		.bg-2{
			background-color: <?=$set->color2?>;
		}
		.bdg-1,
		.hovbtn1:hover,
		.arrow-slick1{
			color: #fff;
			background-color: <?=$set->color1?>;
		}
		.hovbtn2:hover{
			color: #333;
			background-color: <?=$set->color2?>;
		}
		.bdg-2,
		.block2-labelnew::before,
		.arrow-slick1:hover{
			color: #fff;
			background-color: <?=$set->color2?>;
		}
		.hov1:hover {
			border: 1px solid <?=$set->color1?>;
			background-color: white;
			color: <?=$set->color1?>;
		}
		.active-pagination1 {
			border-color: <?=$set->color1?>;
			background-color: <?=$set->color1?>;
			color: white;
		}
		.active-pagination1:hover {
			border-color: <?=$set->color1?>;
			background-color: white;
			color: <?=$set->color1?>;
		}
		.toaster,
		.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
			border-bottom: 3px solid <?=$set->color1?>;
			color: <?=$set->color1?>;
		}
		.main_menu > li:hover > a{
			border-bottom: 2px solid <?=$set->color1?>;
		}
		.toaster .img img{
			border: 1px solid <?=$set->color1?>;
		}
		.block2-overlay{ cursor: pointer;}
		.blog:hover .titel{
			color: <?=$set->color1?>;
		}
	</style>
</head>
<body>

	<!-- Header -->
	<?php if(isset($titel)){ ?>
	<div class="header-divider"></div>
	<?php }else{ ?>
	<div class="home-header-divider"></div>
	<?php } ?>

	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="wrap_header">
				<!-- Logo -->
				<a href="<?= site_url() ?>" class="logo">
					<img src="<?= base_url('cdn/assets/img/'.$set->logo) ?>" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="<?= site_url() ?>">Home</a>
								<!-- <ul class="sub_menu">
									<li><a href="index.html">Homepage V1</a></li>
									<li><a href="home-02.html">Homepage V2</a></li>
									<li><a href="home-03.html">Homepage V3</a></li>
								</ul> -->
							</li>

							<li>
								<a href="<?= site_url('shop') ?>">Shop</a>
							</li>

							<li>
								<a href="<?=site_url('shop/preorder')?>">Pre Order</a>
							</li>
							
							<li>
								<a href="<?=site_url('page/pengiriman')?>">Pengiriman</a>
							</li>
							
							<li>
								<a href="<?=site_url('blog')?>">Blog</a>
							</li>
							
							<?php if($this->func->cekLogin() != true){ ?>
							<li>
								<a href="<?=site_url('home/signin')?>">Login</a>
							</li>
							<?php }else{ ?>
							<li>
								<a href="<?=site_url('manage/pesanan')?>">Pesananku</a>
							</li>
							<?php } ?>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<?php if($this->func->cekLogin() == true){ $notif = $this->func->getPesanNotif(); ?>
					
					<a href="javascript:void(0)" onclick="$('#modalpilihpesan').modal()" class="header-wrapicon1 dis-block notif">
						<img src="<?= base_url('assets/images/icons/pesan.png') ?>" class="header-icon1" alt="ICON">
						<?php if($notif>0){ ?><b class="badge badge-danger"><?=$notif?></b><?php } ?>
					</a>
					 &nbsp;  &nbsp; 
					 &nbsp;  &nbsp; 
					<a href="<?=site_url('manage')?>" class="header-wrapicon1 dis-block">
						<img src="<?= base_url('assets/images/icons/icon-header-01.png') ?>" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>
					
					<?php } ?>
					<a href="<?=site_url('home/keranjang')?>" class="header-wrapicon1 dis-block">
						<img src="<?= base_url('assets/images/icons/icon-header-02.png') ?>" class="header-icon1" alt="ICON">
						<span class="header-icons-noti"><?=$this->func->getKeranjang()?></span>
					</a>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="<?=site_url()?>" class="logo-mobile">
				<img src="<?= base_url('cdn/assets/img/'.$set->logo) ?>" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<?php if($this->func->cekLogin() == true){ ?>
					
					<a href="javascript:void(0)" onclick="$('#modalpilihpesan').modal()" class="header-wrapicon1 dis-block notif">
						<img src="<?= base_url('assets/images/icons/pesan.png') ?>" class="header-icon1" alt="ICON">
						<?php if($notif>0){ ?><b class="badge badge-danger"><?=$notif?></b><?php } ?>
					</a>
					 &nbsp;  &nbsp; 
					<a href="<?=site_url('manage')?>" class="header-wrapicon1 dis-block">
						<img src="<?= base_url('assets/images/icons/icon-header-01.png') ?>" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>
					
					<?php } ?>
					<a href="<?=site_url('home/keranjang')?>" class="header-wrapicon1 dis-block">
						<img src="<?= base_url('assets/images/icons/icon-header-02.png') ?>" class="header-icon1" alt="ICON">
						<span class="header-icons-noti"><?=$this->func->getKeranjang()?></span>
					</a>
				</div>
				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box m-r-14">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-menu-mobile bg-1">
						<a href="<?= site_url() ?>">Home</a>
						<!-- <ul class="sub-menu">
							<li><a href="index.html">Homepage V1</a></li>
							<li><a href="home-02.html">Homepage V2</a></li>
							<li><a href="home-03.html">Homepage V3</a></li>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i> -->
					</li>

					<li class="item-menu-mobile bg-1">
						<a href="<?= site_url('shop') ?>">Shop</a>
					</li>

					<li class="item-menu-mobile bg-1">
						<a href="<?=site_url('shop/preorder')?>">Pre Order</a>
					</li>

					<li class="item-menu-mobile bg-1">
						<a href="<?=site_url('page/pengiriman')?>">Pengiriman</a>
					</li>

					<li class="item-menu-mobile bg-1">
						<a href="<?=site_url('blog')?>">Blog</a>
					</li>

					<?php if($this->func->cekLogin() != true){ ?>
						<li class="item-menu-mobile bg-1">
							<a href="<?=site_url('home/signin')?>">Login / Signup</a>
						</li>
					<?php }else{ ?>
						<li class="item-menu-mobile bg-1">
							<a href="<?=site_url('manage/pesanan')?>">Pesananku</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</header>