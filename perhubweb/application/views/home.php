

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<?php
					$this->db->where("tgl<=",date("Y-m-d H:i:s"));
					$this->db->where("tgl_selesai>=",date("Y-m-d H:i:s"));
					$this->db->where("jenis",1);
					$this->db->where("status",1);
					$this->db->order_by("id","DESC");
					$sld = $this->db->get("promo");
					if($sld->num_rows() > 0){
						foreach($sld->result() as $s){
				?>
				<div class="item-slick1 item1-slick1" style="cursor:pointer;" onclick="window.location.href = '<?=$s->link?>'">
					<div class="wrap-content-slide1 sizefull flex-col-c-m">
						<img src="<?= base_url('cdn/promo/'.$s->gambar) ?>" />
					</div>
				</div>
				<?php
						}
					}else{
				?>
				<div class="item-slick1 item1-slick1" style="background-image: url(<?= base_url('uploads/sliders/slider3.jpg') ?>);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							Hijab Collection <?=date("Y")?>
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							New arrivals
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="<?=site_url('shop')?>" class="flex-c-m size2 bo-rad-23 s-text2 bg-gold hov1 trans-0-4">
								Shop Now
							</a>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</section>

	<!-- Kategori -->
	<section class="banner bgwhite p-t-45 p-b-40">
		<div class="container">
			<div class="sec-title p-b-30">
				<h3 class="m-text5 t-center color1">
					kategori
				</h3>
			</div>
			<div class="cat">
			<?php
				$this->db->where("parent",0);
				$db = $this->db->get("kategori");
				foreach($db->result() as $r){
			?>
				<div class="cat-item">
					<div class="cat-bg" style="background-position:center center;background-image:url('<?=base_url("cdn/kategori/".$r->icon)?>');background-size:cover;" onclick="window.location.href='<?=site_url("kategori/".$r->url)?>'">
						<div class="nama"><?=$r->nama?></div>
					</div>
				</div>
			<?php
				}
			?>
			</div>
		</div>
	</section>

	<!-- Banner -->
	<section class="banner m-b-60 bgijo playstore-section">
		<div class="container row align-center">
			<div class="col-md-8">
				<div class="m-t-24 showsmall"></div>
				<h2>Belanja lebih mudah</h2>
				<h5>Langsung dari handphone Anda, download aplikasinya sekarang!</h5>
			</div>
			<div class="col-md-4">
				<a href="https://play.google.com/store/apps/details?id=com.bikin.online" class="playstore">
					<img src="<?=base_url("assets/images/playstore.png")?>" />
				</a>
				<div class="m-t-10 showsmall"></div>
			</div>
		</div>
	</section>

	<!-- Space Iklan -->
	<?php
		$this->db->where("tgl<=",date("Y-m-d H:i:s"));
		$this->db->where("tgl_selesai>=",date("Y-m-d H:i:s"));
		$this->db->where("jenis",2);
		$this->db->where("status",1);
		$this->db->order_by("id","DESC");
		$ikl = $this->db->get("promo");

		if($ikl->num_rows() > 0){
	?>
	<section class="banner m-b-20 playstore-section">
		<div class="container row align-center">
			<?php
				foreach($ikl->result() as $iklan){
			?>
				<div class="col-md-4 iklan">
					<a href="<?=$iklan->link?>">
						<img src="<?= base_url('cdn/promo/'.$iklan->gambar) ?>" />
					</a>
				</div>
			<?php
				}
			?>
		</div>
	</section>
	<?php
		}
	?>

	<!-- New Product -->
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center color1">
					New Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="row">
				<?php
					$this->db->where("preorder !=",1);
					$this->db->limit(300);
					$this->db->order_by("stok DESC,tglupdate DESC");
					$db = $this->db->get("produk");
					$totalproduk = 0;
					foreach($db->result() as $r){
						$level = isset($_SESSION["lvl"]) ? $_SESSION["lvl"] : 0;
						if($level == 5){
							$result = $r->hargadistri;
						}elseif($level == 4){
							$result = $r->hargaagensp;
						}elseif($level == 3){
							$result = $r->hargaagen;
						}elseif($level == 2){
							$result = $r->hargareseller;
						}else{
							$result = $r->harga;
						}
						$ulasan = $this->func->getReviewProduk($r->id);

						$this->db->where("idproduk",$r->id);
						$dbv = $this->db->get("produkvariasi");
						$totalstok = ($dbv->num_rows() > 0) ? 0 : $r->stok;
						$hargs = 0;
						$harga = array();
						foreach($dbv->result() as $rv){
							$totalstok += $rv->stok;
							if($level == 5){
								$harga[] = $rv->hargadistri;
							}elseif($level == 4){
								$harga[] = $rv->hargaagensp;
							}elseif($level == 3){
								$harga[] = $rv->hargaagen;
							}elseif($level == 2){
								$harga[] = $rv->hargareseller;
							}else{
								$harga[] = $rv->harga;
							}
							$hargs += $rv->harga;
						}

						if($totalstok > 0 AND $totalproduk < 12){
							$totalproduk += 1;
				?>
					<div class="col-6 col-md-4 col-lg-3 p-b-50 cursor-pointer" onclick="window.location.href='<?php echo site_url('produk/'.$r->url); ?>'">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew" style="background-image:url('<?=$this->func->getFoto($r->id,"utama")?>');">
								<!--<img src="" alt="IMG-PRODUCT" style="object-fit:cover;">-->
								<div class="block2-overlay trans-0-4">
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg-1 bo-rad-23 hov1 s-text1 trans-0-4">
											Details
										</button>
									</div>
								</div>
							</div>
							<div class="block2-txt p-t-20">
								<a href="<?php echo site_url('produk/'.$r->url); ?>" class="block2-name dis-block s-text3 p-b-5">
									<?=$r->nama?>
								</a>
								<span class="block2-price m-text6 p-r-5 color1">
									<?php 
										if($hargs > 0){
											echo "Rp. ".$this->func->formUang(min($harga))." - ".$this->func->formUang(max($harga));
										}else{
											echo "Rp. ".$this->func->formUang($result);
										}
									?>
								</span>
							</div>
							<div class="row">
								<div class='col-6'>
									<small><?=$ulasan['ulasan']?> Ulasan</small>
								</div>
								<div class='col-6 text-right'>
									<span class="badge badge-warning bdg-1"><i class='fa fa-star'></i> <?=$ulasan['nilai']?></span>
								</div>
							</div>
						</div>
					</div>
				<?php
						}
					}
							
					if($totalproduk == 0){
						echo "<div class='col-12 text-center m-tb-40'><h2><mark>Produk Kosong</mark></h2></div>";
					}
				?>
					</div>

		</div>
	</section>

	<!-- Blog Terbaru -->
	<div class="container p-t-10 p-b-50" style="background: #f8f9fa1c;">
		<div class="p-t-30 p-b-40 text-center">
			<h2 class="color1"><b>BLOG TERBARU</b></h2>
		</div>
		<div class="row m-t-20 m-b-30" style="justify-content:center;">
			<?php
				$this->db->select("id");
				$dbs = $this->db->get("blog");
				
				$this->db->limit(12,0);
				$this->db->order_by("tgl DESC");
				$db = $this->db->get("blog");
				
				if($db->num_rows() > 0){
					foreach($db->result() as $res){
			?>
				<div class="col-6 col-md-3">
					<div class="blog" onclick="window.location.href='<?=site_url('blog/'.$res->url)?>'">
						<div class="img" style="background-image: url('<?=base_url("cdn/uploads/".$res->img)?>')">
						</div>
						<div class="m-t-10 titel">
							<?=$this->func->potong($res->judul,40,"...")?>
						</div>
						<div class="m-t-10 m-b-20 konten">
							<?=$this->func->potong(strip_tags($res->konten),90,"...")?>
						</div>
					</div>
				</div>
			<?php
					}
				}else{
					echo "
						<div class='text-danger text-center p-tb-20'>
							BELUM ADA POSTINGAN
						</div>
					";
				}
			?>
		</div>
		<div class="m-b-60">
			<!-- Pagination -->
			<div class="pagination flex-m flex-w p-t-26">
				<?=$this->func->createPagination($dbs->num_rows(),1,12)?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function refreshTabel(page){
			window.location.href = "<?=site_url("blog")?>?page="+page;
		}
	</script>

	<?php $notif_booster = $this->func->getSetting("notif_booster"); if($notif_booster == 1){ ?>
	<div id="toaster" class="toaster row col-md-4" style="display:none;">
		<div class="col-3 img p-lr-6"><img id="toast-foto" src="<?=base_url("cdn/uploads/520200116140232.jpg")?>" /></div>
		<div class="col-9 p-lr-6">
			<b id="toast-user">USER</b> telah membeli<br/>
			<b id="toast-produk">Nama Produknya</b>
		</div>
	</div>
	<?php } ?>
	<script type="text/javascript">
		$(function(){
			setTimeout(() => {
				toaster();
			}, 3000);
		});

		<?php if($notif_booster == 1){ ?>
		function toaster(){
			$.post("<?=site_url("assync/booster")?>",{"id":0},function(msg){
				var data = eval("("+msg+")");
				if(data.success == true){
					$("#toast-foto").attr("src",data.foto);
					$("#toast-user").html(data.user);
					$("#toast-produk").html(data.produk);

					$("#toaster").show("slow");
					setTimeout(() => {
						$("#toaster").hide("slow");
						setTimeout(() => {
							toaster();
						}, 3000);
					}, 5000);
				}else{
					setTimeout(() => {
						toaster();
					}, 5000);
				}
			});
		}
		<?php } ?>
	</script>